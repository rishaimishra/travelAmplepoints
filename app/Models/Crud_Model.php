<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Crud_Model extends Model
{
    use HasFactory;
			
	 public static function read($table,$id=0){
		if($id==0){
		  $value=DB::table($table)->orderBy('id', 'desc')->get(); 
		}else{
		  $value=DB::table($table)->where('id', $id)->orderBy('id', 'desc')->first();
		}
		return $value;
 	}
	
	public static function readOne($table,$where){
		  $value=DB::table($table)->where($where)->first();
		return $value;
 	}
	
	public static function readByCondition($table,$where){
		  $value=DB::table($table)->where($where)->orderBy('id', 'desc')->get();
		return $value;
 	}
	
	
	
	public static function insertData($table,$data){
		 return DB::table($table)->insertGetId($data);
		      //  DB::table('users')->insert(['email' => 'kayla@example.com','votes' => 0]);
	}
	
	public static function insertBulkData($table,$data){
		 return DB::table($table)->insert($data);
		      //  DB::table('users')->insert(['email' => 'kayla@example.com','votes' => 0]);
	}
	
	public static function updateData($table,$data,$where){
		 return  DB::table($table)->where($where)->update($data);
	}
	 
	public static function auth_check($table,$data)
	{
	
		$query = DB::table($table)->where([['email', '=', $data['email']],['password', '=', $data['password']],])->first();
		
		if($query){     
			return $query;
		}
		return false;
	}
	
}
