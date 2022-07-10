
<?php


/**
 * @param $page
 * @return string
 */
function url($page = null): string
{
    return $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . ($page ? $page . ".php" : null);
}

/**
 * @param $page
 */
function redirect_to($page = null){
    redirect(url($page));
}
function redirect($page = null){
    header("Location:  $page.php");
    exit();
}
/**
 * @param String $string
 * @return string
 */
function string (string $string ): string
{

    return htmlspecialchars($string);
}


/**
 * @param string $email
 * @return string
 */
function email(string $email): string
{
    return htmlspecialchars(filter_var($email,FILTER_SANITIZE_EMAIL));
}

/**
 * @param $email
 * @return mixed
 */
function is_email($email){
    return filter_var($email,FILTER_VALIDATE_EMAIL);
}

/**
 * @param $var
 * @return mixed
 */
function is_url($var){
    return filter_var(htmlspecialchars($var),FILTER_VALIDATE_URL);
}
/**
 * @param string $url
 * @return mixed|string
 */
function url_validate(string $url){
    return filter_var(htmlspecialchars($url),FILTER_SANITIZE_URL);
}

/**
 * @param int $int
 * @return int|mixed
 */
function int(int $int){
   return filter_var(htmlspecialchars($int),FILTER_SANITIZE_NUMBER_INT);
}


/**
* @param $error_code
* @return mixed
*/
function error($error_code){
    return $error_code;
}


/**
 */
function pre (){
    echo "<pre>";
    var_dump(func_get_args());
    echo "</pre>";
    exit();
}

/**
 * @param null $page
 */
function cookie($page =null){

    if ($page == "login"){
        if (isset($_COOKIE['LOGIN_USER']))
            redirect("home");
    } else{
        if (!isset($_COOKIE['LOGIN_USER']))
            redirect("index");
    }
}

function getUserCookie(){
    return string_hash($_COOKIE['LOGIN_USER'],DECRYPT);
}

function id(){
    return string_hash($_COOKIE['LOGIN_USER_ID'],DECRYPT);
}

function is_set($var): bool
{
    return isset($var);
}
function remove(){
    $var = func_get_args();
    unset($var);
}
 /////////////////////////////////////
/*
 * Security
 */
  /////////////////////////////////////

/**
 * @param $password
 * @return bool|string
 */
function pass_hash($password){
    return password_hash($password,PASSWORD_DEFAULT,['cost' =>12]);
}

/**
 * Encrypt and decrypt
 *
 * @param string $string string to be encrypted/decrypted
 * @param string $action what to do with this? e for encrypt, d for decrypt
 * @param array $option
 * @return bool|string
 *@author Nazmul Ahsan <n.mukto@gmail.com>
 * @link http://nazmulahsan.me/simple-two-way-function-encrypt-decrypt-string/
 *
 */
function string_hash(string $string, string $action = 'e', array $option = [] ) {
    $iv = substr( hash( 'sha256', "mabdulmonem_ana_a7a_iv" ), 0, 16 );
    return ( $action == 'd' )
        ? $output = openssl_decrypt( base64_decode( string($string) ), "AES-256-CBC",  hash( 'sha256', "mabdulmonem_ana_a7a_key" ), 0, $iv )
        : $output = base64_encode( openssl_encrypt( string($string), "AES-256-CBC",  hash( 'sha256', "mabdulmonem_ana_a7a_key" ), 0, $iv ) );
}

/**
 * @param int $length
 * @return bool|string
 */
function string_random(int $length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

/////////////////////////////////////
/*
 *  Template Functions
 */
////////////////////////////////////

/**
 * if you need include head put it null
 * @param $type
 * @param null $head
 */

function temp($type,$head=null){
    if ($type == "header"){
        if ($head == null)
        {
            require_once HEADER;
            require_once HEAD;
        }else
            require_once HEADER;
    } elseif ($type == "footer"){
        require_once FOOTER;
    }
}

/**
 * @param null $file
 * @return null
 */
function assets($file = null){
    return DIR_PUBLIC . $file ? $file : null;
}

/**
 * @param null $file
 * @return null
 */
function css($file = null){
    $css = CSS;
    return $css .= $file ? $file : null;
}
/**
 * @param null $file
 * @return null
 */
function js($file = null){
    $js = JS;
    return $js .= $file ? $file : null;
}
/**
 * @param null $file
 * @return null
 */
function img($file = null){
    $img = IMG ;
    return $img .= $file ? $file : null;
}

/**
 * @param array $data
 * @param null $status
 * @param null $msg
 * @param null $login
 * @return false|string
 */
function json($data=[], $status= null, $msg = null, $login = null){
    return json_encode(['data'=>$data,'status'=>$status,'msg'=>$msg, "api_token" => $login ? $login : null]);
}

/**
 * @param null $var
 * @return array
 */
function request($var = null){
    if ($var){
        return array_key_exists($var,$_POST)
            ? $_POST[$var]
            : (array_key_exists($var,$_GET)
                ? $_GET[$var]
                : null);
    }
    else return [$_POST,$_GET];
}

/**
 * @param $var
 * @return bool
 */
function post($var){
    return (array_key_exists($var,$_POST) && is_set($_POST[$var]) && ! empty($_POST[$var]))
        ? $_POST[$var]
        : false;
}

/***
 * @param string $post
 * @param $action
 * @return bool
 */
function post_check($action, string $post= "action"): bool
{
    return post($post) == $action;
}
/**
 * @param null $var
 * @return mixed
 */
function server($var = null){
    return array_key_exists(strtoupper($var),$_SERVER) ? $_SERVER[strtoupper($var)] : $_SERVER;
}

/**
 * @param null $method
 * @return bool
 */
function request_check($method = "POST"): bool
{
    return (server('REQUEST_METHOD') === strtoupper($method));
}
function is_ajax(): bool
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
