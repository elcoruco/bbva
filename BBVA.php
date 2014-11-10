<?php
/** 
* BBVA the easy way
* @author @elcoruco <boris@gobiernofacil.com>
*/

class BBVA{
  /*
  * config data
  * -------------------------------------------------------------
  */

  // ENDPOINTS
  const MERCHANTS_CATS_ENDPOINT = "https://apis.bbvabancomer.com/datathon/info/merchants_categories";
  const ZIP_RANK_ENDPOINT       = "https://apis.bbvabancomer.com/datathon/info/zipcodes";
  const TILES_RANK_ENDPOINT     = "https://apis.bbvabancomer.com/datathon/info/tiles";

  // BASE_ENDPOINTS
  const BASE_TILE_ENDPOINT = "https://apis.bbvabancomer.com/datathon/tiles/%lat%/%lng%/";
  const BASE_ZIP_ENDPOINT  = "https://apis.bbvabancomer.com/datathon/zipcodes/%zipcode%/";

  // OPTION ENDPOINTS
  const TILE_BASE_STATS       = "basic_stats";
  const ZIPS_BY_TILE          = "customer_zipcodes";
  const AGE_BY_TILE           = "age_distribution";

  const GENDER_BY_TILE        = "gender_distribution";
  const PAYMENT_BY_TILE       = "payment_distribution";
  const CATEGORY_BY_TILE      = "category_distribution";
  const CONSUMPTION_BY_TILE   = "consumption_pattern";
  const CARDS_CUBE_BY_TILE    = "cards_cube";
  const PAYMENTS_CUBE_BY_TILE = "payments_cube";

  // CREDENTIALS
  public $app_id;
  public $key;

  // MORE STUFF
  public $ch;

  // DEFAULT SETTINGS
  public $settings = [
    'page_size' => 10, 
    'date_min'  => '20140101', 
    'date_max'  => '20140331', 
    'group_by'  => 'month', 
    'by'        => 'incomes'
  ];

  /*
  * constructor
  * -------------------------------------------------------------
  */
  function __construct($app_id, $key){
    $this->app_id = $app_id;
    $this->key    = $key;
  }

  /**
  * base functions
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

  /**
  * tiles functions
  * -------------------------------------------------------------
  */
  public function tiles_base_stats($lat, $lng, $query = []){
    $url = strtr(self::BASE_TILE_ENDPOINT . self::TILE_BASE_STATS, ["%lat%" => $lat, "%lng%" => $lng]);
    return $this->make_conn($url, array_merge($this->settings, $query));
  }

  public function top_zips_by_tile($lat, $lng, $query = []){
    $url = strtr(self::BASE_TILE_ENDPOINT . self::ZIPS_BY_TILE, ["%lat%" => $lat, "%lng%" => $lng]);
    return $this->make_conn($url, array_merge($this->settings, $query));
  }

  public function age_distribution_by_tile($lat, $lng, $query = []){
    $url = strtr(self::BASE_TILE_ENDPOINT . self::AGE_BY_TILE, ["%lat%" => $lat, "%lng%" => $lng]);
    return $this->make_conn($url, array_merge($this->settings, $query));
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