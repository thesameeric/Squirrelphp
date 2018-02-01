<?php
namespace squirrel;
use PDO;
class squirrel
{
  static $handler = null;
  function __construct()
  {
    # code...
  }
  public function connect($dbname, $username, $password, $host='127.0.0.1') {
    // this function is used for connecting to the database...
    // You are expected to pass the connection details as an array.
    try
    {
      self::$handler = new PDO('mysql:host = '.$host.'; dbname='.$dbname, $username, $password);
      self::$handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e)
    {
      die('Unable to connect to the database');
    };
      return self::$handler;
  }
  function disconnect(){
    return self::$handler = null;
  }
  public static function insert($tablename,$array)
  {
    // array('firstname'=>'john', 'lastname'=>'doe');
    $columnString = implode(',', array_keys($array));
    $valueString = implode(',', array_fill(0, count($array), '?'));
    $sql = "INSERT INTO ".$tablename." ({$columnString}) VALUES ({$valueString})";
    $query = self::$handler->prepare($sql);
    if($query->execute(array_values($array)))
    {
      return true;
    }else{
      return false;
    }
  }
  public static function update($tablename,$row,$id,$array)
  {
    $columns = implode(',', array_keys($array));
    $columns = explode(',', $columns);
    $values = implode(',', array_values($array));
    $values = explode(',', $values);
    $na; $columnString=array();
    $valueArray = array();
    for($i=0; $i<count($columns); $i++)
    {
      $na = $columns[$i]."=?";
      array_push($columnString, $na);
      array_push($valueArray,$values[$i]);
    }
    $cstring = implode(',',$columnString);
    array_push($valueArray, $id);
    $sql = "UPDATE ".$tablename." SET ".$cstring." WHERE ".$row." = ?";
    $query = self::$handler->prepare($sql);
    if($query->execute($valueArray))
    {
      return true;
    }else{
      return false;
    }
  }
  public static function delete($tablename,$row,$id)
  {
    $sql = "DELETE FROM ".$tablename." WHERE ".$row." = ?";
    $query  = self::$handler->prepare($sql);
    if($query->execute(array($id)))
    {
      return true;
    }
    else
    {
      return false;
    }
  }
  public function selectAll($tablename)
	{
		$sql = "SELECT * FROM ".$tablename." ";
		$sql .= " ORDER BY `id` DESC  ";
		$this->query =$this->handler->query($sql);
		return $this->query;
	}
	public function selectById($table,$id)
	{
		if (isset($id))
		{
			$sql = "SELECT * FROM ".$table." WHERE id=?  LIMIT 1";
			$this->query = $this->handler->prepare($sql);
			$this->query->execute(array($id));
			return $this->query;
		}
		else
		{
			return false;
		}
	}
	public function selectColumn($table,$column)
	{
		if (isset($column) && isset($table))
		{
			$sql = "SELECT ".$column." FROM ".$table." ORDER BY id DESC";
			$query = $this->handler->prepare($sql);
			$query->execute(array($id));
			return $query;
		}	else{return false;	}
	}
	public function Find($table,$column,$name)
	{
		if (isset($name))
		{
			$sql = "SELECT * FROM ".$table." WHERE ".$column."=?  ORDER BY id DESC";
			$this->query = $this->handler->prepare($sql);
			$this->query->execute(array($name));
			return $this->query;
		}	else{	return false; }
}
?>
