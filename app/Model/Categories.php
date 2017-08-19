<?php

/**
 * Created by Mauricio
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Categories
{
		private static $instance = NULL;
		private $categories;

		public static function getInstance(){
			if(is_null(self::$instance)){
				self::$instance = new self();
			}
			return self::$instance;

		}
		private function __construct(){
			$categoriesDB = $categories = Category::all();
			$this->categories = array();
			foreach ($categoriesDB as $cat) {
				$this->categories[$cat->id]=$cat;
			}
    	}
    	public function getCategories(){
    		return $this->categories;
    	}
    	public function getCategory($id){
    		return $this->categories[$id];
    	}
}
