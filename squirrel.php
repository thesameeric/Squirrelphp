<?php
namespace squirrel;
use PDO;
class squirrel
{
  var $handler = null;
  static $instance = null;
  private function __construct()
  {
    //Defualt constructor..
  }
  public static function getInstance()
  {
    if (null == self::$instance)
    {
      self::$instance = new static();
    }else{}
      return self::$instance;
  }
  public function connect($dbname, $username, $password, $host='127.0.0.1')
  {
      try
      {
        $this->handler = new PDO('mysql:host = '.$host.'; dbname='.$dbname, $username, $password);
        $this->handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e)
      {
        die('Unable to connect to the database');
      };
      return $this->handler;
  }
  public function disconnect()
  {
    return $this->handler = null;
  }
  /*
    insert values into the database
    Parameters:
        $tablename - String
        $values - Array
    E.g:
        $tablename - 'users'
        $values - array('firstname'=>'john', 'lastname'=>'doe');
*/
  public function insert($tablename, $values)
  {
    $columnString = implode(',', array_keys($values));
    $valueString = implode(',', array_fill(0, count($values), '?'));
    $sql = "INSERT INTO ".$tablename." ({$columnString}) VALUES ({$valueString})";
    $query = $this->handler->prepare($sql);
    if($query->execute(array_values($values)))
    {
      return true;
    }else{
      return false;
    }
  }
  /*
    Function to update values in database
    Parameters:
        $Tablename - String
        $column - String
        $id - String/Int
        $values - Array
    E.g
        $tablename - 'users'
        $columns - 'id'
        $id - 1
        $values - array('firstname'=>'john', 'lastname'=>'doe');
*/
  public function update($tablename, $column, $id, $values)
  {
      $columns = implode(',', array_keys($values));
      $columns = explode(',', $columns);
      $values = implode(',', array_values($values));
      $values = explode(',', $values);
      $na; $columnString = array();
      $valueArray = array();
      for ($i=0; $i<count($columns); $i++) {
          $na = $columns[$i]."=?";
          array_push($columnString, $na);
          array_push($valueArray,$values[$i]);
      }
      $cstring = implode(',', $columnString);
      array_push($valueArray, $id);
      $sql = "UPDATE " . $tablename . " SET " . $cstring . " WHERE " . $column . " = ?";
      $query = $this->handler->prepare($sql);

      if ($query->execute($valueArray)) {
          return true;
      } else {
          return false;
      }
  }
  /*
    Function to delete a row from the database
    Parameters:
        $tablename - String
        $column - String
        $id - String/Int

    E.g:
        $tablename - 'users'
        $column - ID
        $id - 3
*/
  public function delete($tablename, $column, $id)
  {
    $sql = "DELETE FROM ".$tablename." WHERE ".$column." = ?";
    $query  = $this->handler->prepare($sql);
    if($query->execute(array($id)))
    {
      return true;
    }
    else
    {
      return false;
    }
  }
  /*
    Get all rows from the database table
    Parameters:
        $tablename: String
    E.g
        $tablename - 'users'
*/
  public function selectAll($tablename, $order = "DESC")
	{
		$sql = "SELECT * FROM ".$tablename." ";
		$sql .= " ORDER BY `id` ".$order."  ";
		$query = $this->handler->query($sql);
		return $query;
	}
  /*
    Get row from the database table by id
    Parameters:
        $tablename: String
        $id: Int
    E.g
        $table - 'users'
        $id - 1
*/
	public function selectById($table,$id)
	{
		if (isset($id))
		{
			$sql = "SELECT * FROM ".$table." WHERE id=?  LIMIT 1";
			$query = $this->handler->prepare($sql);
			$query->execute(array($id));
			return $query;
		}
		else
		{
			return false;
		}
	}
  /*
    Select an entire column from a database.
  */
	public function selectColumn($table, $column)
	{
		if (isset($column) && isset($table))
		{
			$sql = "SELECT ".$column." FROM ".$table." ORDER BY id DESC";
			$query = $this->handler->prepare($sql);
			$query->execute(array($id));
			return $query;
		}	else{return false;	}
	}
  /**
  * function to find a particlar row in a databasee.
   */
	public function Find($table, $column ,$name)
	{
		if (isset($name))
		{
			$sql = "SELECT * FROM ".$table." WHERE ".$column."=?  ORDER BY id DESC";
			$query = $this->handler->prepare($sql);
			$query->execute(array($name));
			return $query;
		}	else{	return false; }
  }
}
