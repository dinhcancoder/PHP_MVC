<?php

class Order_Model extends Database
{
  public function Add($OrderID, $UserID, $Anmout, $TransactionFee, $Method, $Status, $Date, $Time, $Code, $Email)
  {
    $sql = "INSERT INTO orders (order_id, user_id, status, anmount, transactionfee, method, date, time, code, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    return $this->execute($sql, $OrderID, $UserID, $Status, $Anmout, $TransactionFee, $Method, $Date, $Time, $Code, $Email);
  }

  public function List()
  {
    $sql = "SELECT * FROM orders ORDER BY date DESC";
    return $this->queryAll($sql);
  }

  public function SelectByUserID($UserID)
  {
    $sql = "SELECT * FROM orders WHERE user_id = ?";
    return $this->queryAll($sql, $UserID);
  }

  public function Detail($OrderID, $ProductID, $Price, $Quantity, $Subtotal)
  {
    $sql = "INSERT INTO order_detail (order_id, product_id, price, quantity, subtotal) VALUES (?, ?, ?, ?, ?)";
    return $this->execute($sql, $OrderID, $ProductID, $Price, $Quantity, $Subtotal);
  }

  public function DetailList()
  {
    $sql = "SELECT * FROM order_detail";
    return $this->queryAll($sql);
  }

  public function DetailByOrderID($OrderID)
  {
    $sql = "SELECT * FROM order_detail WHERE order_id = ?";
    return $this->queryAll($sql, $OrderID);
  }

  public function OrderByID($OrderID)
  {
    $sql = "SELECT * FROM orders WHERE order_id = ?";
    return $this->queryOne($sql, $OrderID);
  }

  public function ChangeStatus($OrderID, $Status)
  {
    $sql = "UPDATE orders SET status = ? WHERE order_id = ?";
    return $this->execute($sql, $Status, $OrderID);
  }

  // Thống kê doanh thu
  public function RevenueStatistics()
  {
    $sql = "SELECT date, SUM(anmount) AS daily_revenue FROM orders WHERE status = 1 GROUP BY date";
    return $this->queryAll($sql);
  }
}
