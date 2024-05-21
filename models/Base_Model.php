<?php

require MAILER_PATH .  "/src/PHPMailer.php";
require MAILER_PATH .  "/src/SMTP.php";
require MAILER_PATH .  "/src/Exception.php";

class Base_Model extends Database
{

  protected $mail;

  public function __construct()
  {
    $this->mail = new \PHPMailer\PHPMailer\PHPMailer(true);
  }

  public function Paginate($array, $page, $perPage)
  {
    $startIndex = ($page - 1) * $perPage;
    $pagedProducts = array_slice($array, $startIndex, $perPage);
    return $pagedProducts;
  }

  public function Search($table, $columName, $value)
  {
    $sql = "SELECT * FROM $table WHERE $columName LIKE '%$value%'";
    return $this->queryAll($sql);
  }

  public function ShowSearch($categoryID, $priceMin, $priceMax, $sort, $value)
  {
    $sql = "SELECT * FROM product WHERE 1 = 1";

    if (!empty($value)) {
      $sql .= " AND product_name LIKE '%$value%'";
    }

    if (!empty($categoryID)) {
      $sql .= " AND category_id = $categoryID";
    }
    $discountedPriceMin = "(product_price - (product_price * product_discount / 100))";
    if (!empty($priceMin) && !empty($priceMax)) {
      $sql .= " AND $discountedPriceMin BETWEEN $priceMin AND $priceMax";
    } else if (!empty($priceMin)) {
      $sql .= " AND $discountedPriceMin >= $priceMin";
    } else if (!empty($priceMax)) {
      $sql .= " AND $discountedPriceMin <= $priceMax";
    }

    if (!empty($sort)) {
      $price = "product_price - (product_price * product_discount / 100)";
      switch ($sort) {
        case 1:
          $sql .= " ORDER BY $price ASC";
          break;
        case 2:
          $sql .= " ORDER BY $price DESC";
          break;
        case 3:
          $sql .= " ORDER BY product_name ASC";
          break;
        case 4:
          $sql .= " ORDER BY product_name DESC";
          break;
        case 5:
          $sql .= " AND product_discount != 0";
          break;
        case 6:
          $sql .= " AND inventory != 0";
          break;
      }
    };

    return $this->queryAll($sql);
  }

  public function selectAll($table)
  {
    $sql = "SELECT * FROM $table";
    return $this->queryAll($sql);
  }

  // getall, findbyid, findbycolumn, create, update, delete. search
  public function statisticalProduct()
  {
    $sql = "SELECT tb2.category_id, tb2.category_name,
            COUNT(*) AS quantity,
            MIN(tb1.product_price) AS priceMin,
            MAX(product_price) AS priceMax,
            AVG(product_price) AS priceAVG
            FROM product tb1 JOIN category tb2 ON tb1.category_id = tb2.category_id GROUP BY tb2.category_id, tb2.category_name";
    return $this->queryAll($sql);
  }

  public function mailer()
  {
    $html = '
    <!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
          href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,300;1,400&display=swap"
          rel="stylesheet"
        />
        <title>Template SendMailer</title>
      </head>
      <body
        style="
          font-size: 16px;
          font-weight: 400;
          line-height: 1.9;
          font-family: \'Roboto\', sans-serif;
        "
      >
        <div class="show" style="padding: 45px; background-color: #f5f5f5">
          <div style="background-color: #fff; padding: 45px">
            <div
              class="title"
              style="
                text-align: center;
                padding: 0 0 25px 0;
                font-size: 32px;
                font-weight: 600;
                letter-spacing: 0.3px;
                border-bottom: 1px solid rgba(0, 0, 0, 0.12);
              "
            >
              Xác nhận mã OTP
            </div>
            <div class="body">
              <h1 style="font-weight: 600; font-size: 24px">
                Chào Coder Can (Can đii code dạo),
              </h1>
              <p style="margin-top: 15px; font-size: 16px">
                Bạn vừa nhận được mã OTP xác nhận tại Account Shop.
              </p>
              <span
                style="
                  display: inline-block;
                  color: #2579f2;
                  border: 2px solid rgba(37, 121, 242, 0.5);
                  padding: 2px 15px;
                  border-radius: 5px;
                  font-weight: 600;
                  margin-top: 15px;
                  font-size: 24px;
                "
                >438536</span
              >
              <p style="margin-top: 15px; font-size: 16px">
                Nếu bạn không thực hiện yêu cầu này xin vui lòng bỏ qua nó hoặc nếu
                cần hỗ trợ hãy liên hệ với chúng tôi ngay.
              </p>
              <p style="margin-top: 15px; font-size: 16px">
                Trân trọng <br />
                Account Shop
              </p>
            </div>
          </div>
          <p style="text-align: center; margin-top: 25px">
            Hotline hỗ trợ: 0373 405 375
          </p>
        </div>
      </body>
    </html>
    ';
    $headers = array(
      "MIME-Version: 1.0",
      "Content-type:text/html;charset=UTF-8"
    );

    $this->SendMail("caodinhcan10@gmail.com", "Confirm Number Code", $html, $headers);
  }

  public function SendMail($to, $subject, $body, $headers)
  {
    try {
      $this->mail->isSMTP();
      // Cấu hình thông tin SMTP...
      $this->mail->Host = 'smtp.gmail.com'; // Địa chỉ SMTP server của bạn
      $this->mail->Port = 587; // Cổng SMTP, tuỳ thuộc vào cấu hình của bạn
      $this->mail->SMTPAuth = true; // Bật chế độ xác thực SMTP
      $this->mail->Username = 'dinhcan.cntt@gmail.com'; // Tên đăng nhập SMTP của bạn
      $this->mail->Password = 'uxoctehbloaywzby'; // Mật khẩu SMTP của bạn

      $this->mail->setFrom('admin@gmail.com', 'Shop Account'); // Email và tên người gửi
      $this->mail->addAddress($to); // Email người nhận

      // Cấu hình nội dung email
      $this->mail->Subject = $subject; // Tiêu đề email
      $this->mail->Body = $body; // Nội dung email (có thể sử dụng HTML)

      // Thêm các thông số trong biến $headers
      foreach ($headers as $header) {
        $this->mail->addCustomHeader($header);
      }

      $this->mail->send();
    } catch (Exception $e) {
      echo 'Gửi mail không thành công: ', $this->mail->ErrorInfo;
    }
  }
}
