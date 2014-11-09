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

  const TILES_BASE_STATS_ENDPONT = "https://apis.bbvabancomer.com/datathon/tiles/%lat%/%lng%/basic_stats";

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

  public function top_tiles(){
    return $this->make_conn(self::TILES_RANK_ENDPOINT);
  }

  public function tiles_base_stats($lat, $lng, $query = ['page_size' => 10, 'date_min' => '20140101', 'date_max' => '20140331', 'group_by' => 'month']){
    $trans = ["%lat%" => $lat, "%lng%" => $lng];
    $url = strtr(self::TILES_BASE_STATS_ENDPONT, $trans);
    return $this->make_conn($url, $query);
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