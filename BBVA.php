<?php
/** 
* BBVA easy way
* @author @elcoruco <boris@gobiernofacil.com>
*/

class BBVA{
  /*
  * config data
  * -------------------------------------------------------------
  */

  // ENDPOINTS
  const MERCHANTS_CATS_ENDPOINT = "https://apis.bbvabancomer.com/datathon/info/merchants_categories";
  const ZIP_RANK_ENDPOINT = "https://apis.bbvabancomer.com/datathon/info/zipcodes";
  const TILES_RANK_ENDPOINT = "https://apis.bbvabancomer.com/datathon/info/tiles";

  // CREDENTIALS
  public $app_id;
  public $key;

  // MORE STUFF
  public $ch;

  /*
  * constructor
  * -------------------------------------------------------------
  */
  function __construct($app_id, $key){
    $this->app_id = $app_id;
    $this->key    = $key;
  }

  /**
  * main functions
  * -------------------------------------------------------------
  */
  public function get_categories(){
    return $this->make_conn(self::MERCHANTS_CATS_ENDPOINT);
  }

  public function top_zips(){
    return $this->make_conn(self::ZIP_RANK_ENDPOINT);
  }

  /*
  * helpers
  * -------------------------------------------------------------
  */
  private function make_conn($url, $params = []){
    $this->ch = curl_init();
    curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($this->ch, CURLOPT_USERPWD, "{$this->app_id}:{$this->key}");
    curl_setopt($this->ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    // set the params, if avaliable
    $url = empty($params) ? $url : $url . '?' . @http_build_query($params);
    curl_setopt($this->ch, CURLOPT_URL, $url);

    // finish the thing
    $response = curl_exec($this->ch);
    curl_close($this->ch);
    return $response;
  }
}