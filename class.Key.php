<?
//Invoices
class GPG_Key extends DBObj {
  protected static $__table="gpg_keys";
  public static $mod="gpg";
  public static $sub="keys";
  private $__handles=array();
  
  public static $elements=array(
  //""=>array("title"=>"","mode"=>"string","dbkey"=>""),
    "privkey"=>array("title"=>"Private Schlüsseldatei","mode"=>"string","dbkey"=>"privkey"),
    "pubkey"=>array("title"=>"Private Schlüsseldatei","mode"=>"string","dbkey"=>"privkey"),
    "active"=>array("title"=>"Status","mode"=>"select","data"=>array("Gesperrt","Aktiv"),"dbkey"=>"active"),
    "passphrase"=>array("title"=>"Passwort","mode"=>"string","dbkey"=>"passphrase"),
    "privkey_handle"=>array("title"=>"Privater Schlüssel (Handle)","mode"=>"process"),
    "pubkey_handle"=>array("title"=>"Öffentlicher Schlüssel (Handle)","mode"=>"process"),
  );
  public static $link_elements=array(
  );
  public static $list_elements=array(
    "privkey",
    "pubkey",
    "active",
  );
  public static $detail_elements=array(
    "privkey",
    "pubkey",
    "active",
  );
  public static $edit_elements=array(
    "privkey",
    "pubkey",
    "passphrase",
    "active",
  );
  public static $links=array(
  );
  public static $one2many=array(
  );
  public function commit() {
  }
  public function processProperty($key) {
    global $config;
    $ret=NULL;
    switch($key) {
      case "privkey_handle":
        if(isset($this->__handles["priv"]))
          return $this->__handles["priv"];
        $raw=@file_get_contents($config["paths"]["filestore"]."/".$this->privkey);
        $ret=openssl_pkey_get_private($raw,$this->passphrase);
      break;
      case "pubkey_handle":
        if(isset($this->__handles["pub"]))
          return $this->__handles["pub"];
        $raw=@file_get_contents($config["paths"]["filestore"]."/".$this->pubkey);
        $ret=openssl_pkey_get_public($raw);
      break;
    }
    return $ret;
  }
}

plugins_register_backend_handler($plugin,"keys","list",array("GPG_Key","listView"));
plugins_register_backend_handler($plugin,"keys","edit",array("GPG_Key","editView"));
plugins_register_backend_handler($plugin,"keys","view",array("GPG_Key","detailView"));
plugins_register_backend_handler($plugin,"keys","submit",array("GPG_Key","processSubmit"));
