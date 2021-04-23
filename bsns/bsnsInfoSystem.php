<?php
include('bsnsDataSystem.php');
class InfoSystem extends DataSystem
{
    private $bConnection;
    private function OpenDB()
    {
        $bConnection = new mysqli(DataSystem::dbHost, DataSystem::dbUser, DataSystem::dbPwd, DataSystem::dbName);
    		if ($bConnection->connect_errno)
    		{
    			//echo 'NOK: (Error: '.$mysqli->connect_errno.') '.$mysqli->connect_error;
    			$this->bConnection = false;
    		}
    		else
    		{
    			//echo 'OK '.$mysqli->host_info;
    			$this->bConnection = $bConnection;
    		}
    }

    private function CloseDB()
    {
        mysqli_close($this->bConnection);
    }

    /*private function GetQueryUSP($i, $arg1 = 'N/A', $arg2 = 'N/A', $arg3 = 'N/A', $arg4 = 'N/A')
  	{
  		return "call uspEvaDo(".$i.",'".$arg1."','".$arg2."','".$arg3."','".$arg4."');";
  	}*/

    public function getStatusDB()//bsnsLogin
  	{
  		$this->OpenDB();
  		$this->CloseDB();
  	}

    public function getUserStatusByEmail($arg)
  	{
      $jsonObj = json_decode(base64_decode($arg));
  		$this->OpenDB();
  		$this->bConnection->set_charset("utf8");
  		$res = $this->bConnection->query("select count(prodUsers.name) as L1 from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$jsonObj->strUs."';");
  		$row = $res->fetch_assoc();
  		$strR = $row['L1'];
  		$this->CloseDB();
  		return $strR;
  	}

    public function getUserShotSystemByEmail($arg)
  	{
      $objJson = json_decode(base64_decode($arg));
  		$this->OpenDB();
  		$this->bConnection->set_charset("utf8");
  		$res = $this->bConnection->query("select shotSystem as L1 from prodUsers where status = 1 and email = '".$objJson->email."';");
  		$row = $res->fetch_assoc();
  		$file_to_search = $row['L1'];
  		$this->CloseDB();

      //$file_to_search = "leon.acor@gmail.com_20210415_162905_5dd3c1bb665723899339a7dde1f1f1c1ad9560bf.jpg";
      $dir='../uploads';
      $email = substr(basename($file_to_search),0,-57);
      $files = scandir($dir);
      foreach($files as $key => $value)
      {
        $realpath = $dir.DIRECTORY_SEPARATOR.$value;
        $path = realpath($realpath);
        if(!is_dir($path))
        {
          $rest = substr(basename($value),0,-57);
          if($email == $rest)
          {
            if($file_to_search != $value)
            {
              unlink($path);
            }
          }
        }
      }

  		return '1';
  	}

    public function setProdLoadJSON($arg)
  	{
      $this->OpenDB();
  		$this->bConnection->set_charset("utf8");
  		$res = $this->bConnection->query("insert into prodLoad (json) values ('".$arg."');");
  		$this->CloseDB();
  		return $res;
  	}

    public function setCountry($code, $name, $strPath){
      $this->OpenDB();
  		$this->bConnection->set_charset("utf8");
  		$res = $this->bConnection->query("insert into catCountries (code,name,path) values ('".$code."','".$name."','".$strPath."');");
  		$this->CloseDB();
  		return $res;
    }

    public function getCountries()
    {
      $this->OpenDB();
  		$res = $this->bConnection->query("select catCountries.code as L1, catCountries.name as L2, catCountries.path as L3 from catCountries where catCountries.status = 1 order by L2 asc;");
  		$rows = array();
  		while($r = mysqli_fetch_assoc($res)) {
  			$rows[] = array_map('utf8_encode', $r);
  		}
  		$this->CloseDB();
  		return json_encode($rows);
    }

    public function getCountCountries()
    {
      $this->OpenDB();
  		$res = $this->bConnection->query("select count(catCountries.code) as L1 from catCountries where catCountries.status = 1;");
      $row = $res->fetch_assoc();
  		$strR = $row['L1'];
  		$this->CloseDB();
  		return $strR;
    }

    public function updateCountry($code){
      $this->OpenDB();
  		$this->bConnection->set_charset("utf8");
  		$res = $this->bConnection->query("update catCountries set catCountries.status = 2 where catCountries.code = '".$code."';");
  		$this->CloseDB();
  		return $res;
    }

    public function setField($name){
      $h = hash('ripemd160',$name.date("Ymd_His"));
      $code = substr($h,0,8);
      $this->OpenDB();
  		$this->bConnection->set_charset("utf8");
  		$res = $this->bConnection->query("insert into catFields (code,name) values ('".$code."','".$name."');");
  		$this->CloseDB();
  		return $res;
    }

    public function getFields()
    {
      $this->OpenDB();
  		$res = $this->bConnection->query("select catFields.code as L1, catFields.name as L2 from catFields where catFields.status = 1 order by L2 asc;");
  		$rows = array();
  		while($r = mysqli_fetch_assoc($res)) {
  			$rows[] = array_map('utf8_encode', $r);
  		}
  		$this->CloseDB();
  		return json_encode($rows);
    }

    public function updateField($code){
      $this->OpenDB();
  		$this->bConnection->set_charset("utf8");
  		$res = $this->bConnection->query("update catFields set catFields.status = 2 where catFields.code = '".$code."';");
  		$this->CloseDB();
  		return $res;
    }

    public function setSkill($name){
      $h = hash('ripemd160',$name.date("Ymd_His"));
      $code = substr($h,0,8);
      $this->OpenDB();
  		$this->bConnection->set_charset("utf8");
  		$res = $this->bConnection->query("insert into catSkills (code,name) values ('".$code."','".$name."');");
  		$this->CloseDB();
  		return $res;
    }

    public function getSkills()
    {
      $this->OpenDB();
  		$res = $this->bConnection->query("select catSkills.code as L1, catSkills.name as L2 from catSkills where catSkills.status = 1 order by L2 asc;");
  		$rows = array();
  		while($r = mysqli_fetch_assoc($res)) {
  			$rows[] = array_map('utf8_encode', $r);
  		}
  		$this->CloseDB();
  		return json_encode($rows);
    }

    public function updateSkill($code){
      $this->OpenDB();
      $this->bConnection->set_charset("utf8");
      $res = $this->bConnection->query("update catSkills set catSkills.status = 2 where catSkills.code = '".$code."';");
      $this->CloseDB();
      return $res;
    }

    public function setFieldsSkills($codeField,$codeSkill){
      $h = hash('ripemd160',$codeField.$codeSkill.date("Ymd_His"));
      $code = substr($h,0,8);
      $this->OpenDB();
  		$this->bConnection->set_charset("utf8");
  		$res = $this->bConnection->query("insert into chFieldsSkills (code,idcatFields,idcatSkills) values ('".$code."',(select catFields.idcatFields AS L1 from catFields where catFields.status = 1 and catFields.code = '".$codeField."'),(select catSkills.idcatSkills AS L1 from catSkills where catSkills.status = 1 and catSkills.code = '".$codeSkill."'));");
  		$this->CloseDB();
  		return $res;
    }

    public function getFieldsSkills(){
      $this->OpenDB();
  		$res = $this->bConnection->query("select catFields.code as L1, catFields.name as L2, catSkills.code as L3, catSkills.name as L4, chFieldsSkills.code as L5 from chFieldsSkills inner join catFields on chFieldsSkills.idcatFields = catFields.idcatFields inner join catSkills on chFieldsSkills.idcatSkills = catSkills.idcatSkills where chFieldsSkills.status = 1 and catFields.status = 1 and catSkills.status = 1 order by L2,L4 asc;");
      //$res = $this->bConnection->query("select catFields.code as L1, catFields.name as L2, catSkills.code as L3, catSkills.name as L4, chFieldsSkills.code as L5, (select count(distinct(catFields.code)) as A1 from catFields where catFields.status = 1) AS L6, (select count(distinct(catSkills.code)) as O1 from catSkills where catSkills.status = 1) AS L7 from chFieldsSkills inner join catFields on chFieldsSkills.idcatFields = catFields.idcatFields inner join catSkills on chFieldsSkills.idcatSkills = catSkills.idcatSkills where chFieldsSkills.status = 1 and catFields.status = 1 and catSkills.status = 1 order by L2,L4 asc;");
  		$rows = array();
  		while($r = mysqli_fetch_assoc($res)) {
  			$rows[] = array_map('utf8_encode', $r);
  		}
  		$this->CloseDB();
  		return json_encode($rows);
    }

    public function getCountSkillsByField(){
      $this->OpenDB();
  		$res = $this->bConnection->query("select catFields.name as L1, catFields.code as L2, count(catFields.code) as L3 from chFieldsSkills inner join catFields on chFieldsSkills.idcatFields = catFields.idcatFields where chFieldsSkills.status = 1 and catFields.status = 1 group by L1,L2 order by L1;");
  		$rows = array();
  		while($r = mysqli_fetch_assoc($res)) {
  			$rows[] = array_map('utf8_encode', $r);
  		}
  		$this->CloseDB();
  		return json_encode($rows);
    }

    public function setUser($arg){
      $json = json_decode(base64_decode($arg));
      $this->OpenDB();
  		$this->bConnection->set_charset("utf8");
  		$res = $this->bConnection->query("insert into prodUsers (name,email,pwd,idcatCountry,last,nickname,shotUser,shotSystem,bio,yt,ig,vi) values ('".$json->name."','".$json->email."','".$json->pwd."',(select catCountries.idcatCountries as L1 from catCountries where catCountries.status = 1 and catCountries.code='".$json->country."'),'".$json->lastname."','".$json->nickname."','".$json->shotUser."','".$json->shotSystem."','".$json->bio."','".$json->yt."','".$json->ig."','".$json->vi."');");
  		$this->CloseDB();
  		return $res;
      //return base64_decode($arg);
      //return "insert into prodUsers (name,email,pwd,idcatCountry,last,nickname,shotUser,shotSystem,bio,yt,ig,vi) values ('".$json->name."','".$json->email."','".$json->pwd."',(select catCountries.idcatCountries as L1 from catCountries where catCountries.status = 1 and catCountries.code='".$json->country."'),'".$json->lastname."','".$json->nickname."','".$json->shotUser."','".$json->shotSystem."','".$json->bio."','".$json->yt."','".$json->ig."','".$json->vi."');";
    }

    public function setUsersFieldsSkills($arg){
      $json = json_decode(base64_decode($arg));
      $strVal = '';
      foreach ($json as $key => $value) {
        if("cbValSkill" == substr($key,0,10)){
          $this->OpenDB();
          $this->bConnection->set_charset("utf8");
          $res = $this->bConnection->query("insert into chUserFieldsSkills (idchFieldsSkills,idprodUsers) values ((select idchFieldsSkills as L1 from chFieldsSkills where chFieldsSkills.status = 1 and chFieldsSkills.code = '".$value."'),(select idprodUsers from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$json->email."'));");
          $this->CloseDB();
          $strVal = $value;
        }
      }
      return '1';
      //return base64_decode($arg);
      //return "insert into chUserFieldsSkills (idchFieldsSkills,idprodUsers) values ((select idchFieldsSkills as L1 from chFieldsSkills where chFieldsSkills.status = 1 and chFieldsSkills.code = '".$strVal."'),(select idprodUsers from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$json->email."'));";
    }

    public function setUsersCountries($arg){
      $json = json_decode(base64_decode($arg));
      $strVal = '';
      foreach ($json as $key => $value) {
        if("cbValPlace" == substr($key,0,10)){
          $this->OpenDB();
          $this->bConnection->set_charset("utf8");
          $res = $this->bConnection->query("insert into chUserCountries (idprodUsers,idcatCountries) values ((select idprodUsers from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$json->email."'),(select idcatCountries as L1 from catCountries where catCountries.status = 1 and catCountries.code = '".$value."'));");
          $this->CloseDB();
          $strVal = $value;
        }
      }
      return '1';
      //return base64_decode($arg);
      //return "insert into chUserFieldsSkills (idchFieldsSkills,idprodUsers) values ((select idchFieldsSkills as L1 from chFieldsSkills where chFieldsSkills.status = 1 and chFieldsSkills.code = '".$strVal."'),(select idprodUsers from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$json->email."'));";
    }

    public function getUserStatus($arg)
  	{
      $jsonObj = json_decode(base64_decode($arg));
  		$this->OpenDB();
  		$this->bConnection->set_charset("utf8");
  		$res = $this->bConnection->query("select count(prodUsers.name) as L1 from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$jsonObj->arg1."' and prodUsers.pwd='".$jsonObj->arg2."';");
  		$row = $res->fetch_assoc();
  		$strR = $row['L1'];
  		$this->CloseDB();
  		return $strR;
  	}

    public function getUserStatusForAdmin($arg)
  	{
      $jsonObj = json_decode(base64_decode($arg));
  		$this->OpenDB();
  		$this->bConnection->set_charset("utf8");
  		$res = $this->bConnection->query("select count(prodUsers.name) as L1 from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$jsonObj->arg1."' and prodUsers.pwd='".$jsonObj->arg2."' and prodUsers.adm=1;");
  		$row = $res->fetch_assoc();
  		$strR = $row['L1'];
  		$this->CloseDB();
  		return $strR;
  	}

    public function getUser($arg,$arrSkillsPlaces){
        $jsonObj = json_decode(base64_decode($arg));
        $this->OpenDB();
    		$res = $this->bConnection->query("select prodUsers.name as name,email as email,(select catCountries.path as E1 from catCountries where catCountries.status = 1 and catCountries.idCatCountries = (select prodUsers.idcatCountry as O1 from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$jsonObj->arg1."') ) as countryFlag, (select catCountries.code as E1 from catCountries where catCountries.status = 1 and catCountries.idCatCountries = (select prodUsers.idcatCountry as O1 from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$jsonObj->arg1."') ) as country, last as lastname, nickname, shotSystem as shotSystem,bio as bio,yt as yt,ig as ig,vi as vi from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$jsonObj->arg1."';");
        //$res = $this->bConnection->query("select prodUsers.name as name,email as email,(select catCountries.path as E1 from catCountries where catCountries.status = 1 and catCountries.idCatCountries = (select prodUsers.idcatCountry as O1 from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$jsonObj->arg1."' /*and prodUsers.pwd = '".$jsonObj->arg2."'*/) ) as countryFlag, (select catCountries.code as E1 from catCountries where catCountries.status = 1 and catCountries.idCatCountries = (select prodUsers.idcatCountry as O1 from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$jsonObj->arg1."' /*and prodUsers.pwd = '".$jsonObj->arg2."'*/) ) as country, last as lastname, nickname, shotSystem as shotSystem,bio as bio,yt as yt,ig as ig,vi as vi from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$jsonObj->arg1."' /*and prodUsers.pwd = '".$jsonObj->arg2."'*/;");
    		//$rows = array();
    		while($r = mysqli_fetch_array($res)) {
    			$arrSkillsPlaces['name'] = utf8_encode($r['name']);
          $arrSkillsPlaces['email'] = $r['email'];
          $arrSkillsPlaces['countryFlag'] = utf8_encode($r['countryFlag']);
          $arrSkillsPlaces['country'] = utf8_encode($r['country']);
          $arrSkillsPlaces['lastname'] = utf8_encode($r['lastname']);
          $arrSkillsPlaces['nickname'] = utf8_encode($r['nickname']);
          $arrSkillsPlaces['shotSystem'] = $r['shotSystem'];
          $arrSkillsPlaces['bio'] = utf8_encode($r['bio']);
          $arrSkillsPlaces['yt'] = utf8_encode($r['yt']);
          $arrSkillsPlaces['ig'] = utf8_encode($r['ig']);
          $arrSkillsPlaces['vi'] = utf8_encode($r['vi']);

    		}
    		$this->CloseDB();
    		return base64_encode(json_encode($arrSkillsPlaces));
    }

    public function getSkillsByUserForUpdate($arg){
        $objJson = json_decode(base64_decode($arg));
        $this->OpenDB();
    		$res = $this->bConnection->query("select chFieldsSkills.code as L1, catSkills.name as L2 from prodUsers inner join chUserFieldsSkills on prodUsers.idprodUsers = chUserFieldsSkills.idprodUsers inner join chFieldsSkills on chUserFieldsSkills.idchFieldsSkills = chFieldsSkills.idchFieldsSkills inner join catSkills on chFieldsSkills.idcatSkills = catSkills.idcatSkills where catSkills.status=1 and prodUsers.status=1 and chUserFieldsSkills.status = 1 and chFieldsSkills.status = 1 and prodUsers.email = '".$objJson->arg1."';");
    		$rows = array();
        $i=0;
    		while($r = mysqli_fetch_array($res)) {
          $key = 'cbValSkill'.$i;
          $keySkill = 'skill'.$r['L1'];
          $rows[$key]=$r['L1'];
          $rows[$keySkill]=utf8_encode($r['L2']);
          $i++;
    		}
    		$this->CloseDB();
        return $rows;
        //return "select chFieldsSkills.code as L1 from prodUsers inner join chUserFieldsSkills on prodUsers.idprodUsers = chUserFieldsSkills.idprodUsers inner join chFieldsSkills on chUserFieldsSkills.idchFieldsSkills = chFieldsSkills.idchFieldsSkills inner join catSkills on chFieldsSkills.idcatSkills = catSkills.idcatSkills where catSkills.status=1 and prodUsers.status=1 and chUserFieldsSkills.status = 1 and chFieldsSkills.status = 1 and prodUsers.email = '".$objJson->arg1."';";
    }

    public function getPlacesByUserForUpdate($arg,$arrSkills){
        $objJson = json_decode(base64_decode($arg));
        $this->OpenDB();
    		$res = $this->bConnection->query("select catCountries.code as L1, catCountries.path as L2 from prodUsers inner join chUserCountries on prodUsers.idprodUsers = chUserCountries.idprodUsers inner join catCountries on chUserCountries.idcatCountries = catCountries.idcatCountries where catCountries.status = 1 and chUserCountries.status = 1 and prodUsers.status = 1 and prodUsers.email = '".$objJson->arg1."';");
        $i=0;
    		while($r = mysqli_fetch_array($res)) {
          $key = 'cbValPlace'.$i;
          $keyFlag = 'flag'.$r['L1'];
          $arrSkills[$key]=$r['L1'];
          $arrSkills[$keyFlag]=utf8_encode($r['L2']);
          $i++;
    		}
    		$this->CloseDB();
        return $arrSkills;
        //return "select catCountries.code as L1 from prodUsers inner join chUserCountries on prodUsers.idprodUsers = chUserCountries.idprodUsers inner join catCountries on chUserCountries.idcatCountries = catCountries.idcatCountries where catCountries.status = 1 and chUserCountries.status = 1 and prodUsers.status = 1 and prodUsers.email = '".$objJson->arg1."';";
    }

    public function getCountFieldsSkills(){
      $this->OpenDB();
  		$this->bConnection->set_charset("utf8");
  		$res = $this->bConnection->query("select count(chFieldsSkills.code) as L1 from chFieldsSkills WHERE chFieldsSkills.status = 1;");
  		$row = $res->fetch_assoc();
  		$strR = $row['L1'];
  		$this->CloseDB();
  		return $strR;
    }

    public function updatePwdByEmail($arg)
    {
      $objJson = json_decode(base64_decode($arg));
      $this->OpenDB();
      $this->bConnection->set_charset("utf8");
      $res = $this->bConnection->query("update prodUsers set pwd ='".$objJson->arg2."' where prodUsers.email = '".$objJson->strUs."';");
      $this->CloseDB();
      return '1';
    }

    public function getSkillsByUser($arg){
        $objJson = json_decode(base64_decode($arg));
        $this->OpenDB();
    		$res = $this->bConnection->query("select prodUsers.email, catSkills.name from prodUsers inner join chUserFieldsSkills on prodUsers.idprodUsers = chUserFieldsSkills.idprodUsers inner join chFieldsSkills on chUserFieldsSkills.idchFieldsSkills = chFieldsSkills.idchFieldsSkills inner join catSkills on chFieldsSkills.idcatSkills = catSkills.idcatSkills where catSkills.status=1 and prodUsers.status=1 and chUserFieldsSkills.status = 1 and chFieldsSkills.status = 1 and prodUsers.email = '".$objJson->arg1."';");
    		$rows = array();
    		while($r = mysqli_fetch_assoc($res)) {
    			$rows[] = array_map('utf8_encode', $r);
    		}
    		$this->CloseDB();
    		return base64_encode(json_encode($rows));
    }

    public function setLookup($arg){
      $objJson = json_decode(base64_decode($arg));
      $arrSkills = array();
      $arrPlaces = array();
      foreach ($objJson as $key => $value) {
          if("cbValSkill" == substr($key,0,10)){
            $arrSkills[]="'".$value."'";
          }
          if("cbValPlace" == substr($key,0,10)){
            $arrPlaces[]="'".$value."'";
          }
      }

      $this->OpenDB();
      $res = $this->bConnection->query("select u1.L1, u1.L2, u1.L3, u1.L4, u1.L5, u1.L6, u2.L5 as L7 from (select prodUsers.name as L1, group_concat(catSkills.name separator ',') as L2, catCountries.path as L3, prodUsers.email as L4, prodUsers.nickname as L5, prodUsers.shotSystem as L6 from catSkills inner join chFieldsSkills on catSkills.idcatSkills = chFieldsSkills.idcatSkills inner join chUserFieldsSkills on chUserFieldsSkills.idchFieldsSkills = chFieldsSkills.idchFieldsSkills inner join prodUsers on chUserFieldsSkills.idprodUsers = prodUsers.idprodUsers inner join catCountries on prodUsers.idcatCountry = catCountries.idcatCountries where catCountries.status = 1 and  prodUsers.status = 1 and chUserFieldsSkills.status = 1 and chFieldsSkills.status = 1 and catSkills.status = 1 and catSkills.code in (".implode(',', $arrSkills).") and catCountries.code in (".implode(',', $arrPlaces).") and not prodUsers.email = '".$objJson->email."' group by L1,L3,L4,L5,L6) as u1 left join (select t1.nickname as L1, t1.email as L2, t2.nickname as L3, t2.email as L4, 1 as L5 from chUsersLinked inner join prodUsers as t1 on chUsersLinked.idUserSource = t1.idprodUsers inner join prodUsers as t2 on chUsersLinked.idUserLinked = t2.idprodUsers where chUsersLinked.status = 1 and chUsersLinked.request in (4,5) and t1.status = 1 and t1.email = '".$objJson->email."' and t2.status = 1) u2 on u1.L4 = u2.L4");

      //$res = $this->bConnection->query("select prodUsers.name as L1, group_concat(catSkills.name separator ',') as L2, catCountries.path as L3, prodUsers.email as L4, prodUsers.nickname as L5, prodUsers.shotSystem as L6 from catSkills inner join chFieldsSkills on catSkills.idcatSkills = chFieldsSkills.idcatSkills inner join chUserFieldsSkills on chUserFieldsSkills.idchFieldsSkills = chFieldsSkills.idchFieldsSkills inner join prodUsers on chUserFieldsSkills.idprodUsers = prodUsers.idprodUsers inner join catCountries on prodUsers.idcatCountry = catCountries.idcatCountries where catCountries.status =1 and  prodUsers.status = 1 and chUserFieldsSkills.status =1 and chFieldsSkills.status = 1 and catSkills.status = 1 and catSkills.code in (".implode(',', $arrSkills).") and catCountries.code in (".implode(',', $arrPlaces).") and not prodUsers.email = '".$objJson->email."' group by L1,L3,L4,L5,L6; ");

      $rows = array();
      while($r = mysqli_fetch_assoc($res)) {
        $rows[] = array_map('utf8_encode', $r);
      }
      $this->CloseDB();
      return base64_encode(json_encode($rows));
    }

    public function setUsersLinked($arg){
      $objJson = json_decode(base64_decode($arg));
      $this->OpenDB();
      $this->bConnection->set_charset("utf8");
      $res = $this->bConnection->query("insert into chUsersLinked (idUserSource,idUserLinked) values ((select prodUsers.idprodUsers as L1 from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$objJson->arg1."'),(select prodUsers.idprodUsers as L1 from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$objJson->arg2."'));");
      $this->CloseDB();
      return '1';
      //return "insert into chUsersLinked (idUserSource,idUserLinked) values ((select prodUsers.idprodUsers as L1 from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$objJson->arg1."'),(select prodUsers.idprodUsers as L1 from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$objJson->arg2."'))";
    }

    public function setUsersLinkedAccept($arg){
      $objJson = json_decode(base64_decode($arg));
      $this->OpenDB();
      $this->bConnection->set_charset("utf8");
      $res = $this->bConnection->query("insert into chUsersLinked (idUserSource,idUserLinked,request) values ((select prodUsers.idprodUsers as L1 from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$objJson->arg2."'),(select prodUsers.idprodUsers as L1 from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$objJson->arg1."'),'".$objJson->arg3."');");
      $this->CloseDB();
      return '1';
      //return "insert into chUsersLinked (idUserSource,idUserLinked) values ((select prodUsers.idprodUsers as L1 from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$objJson->arg1."'),(select prodUsers.idprodUsers as L1 from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$objJson->arg2."'))";
    }

    public function getUsersLinked($arg){
        $objJson = json_decode(base64_decode($arg));
        //return "select t2.name as L1, group_concat(catSkills.name separator ',') as L2, catCountries.path as L3, t2.email as L4, t2.nickname as L5, t2.shotSystem as L6 from prodUsers as t1 inner join chUsersLinked on t1.idprodUsers = chUsersLinked.idUserSource inner join prodUsers as t2 on chUsersLinked.idUserLinked = t2.idprodUsers inner join chUserFieldsSkills on t2.idprodUsers = chUserFieldsSkills.idprodUsers inner join chFieldsSkills on chUserFieldsSkills.idchFieldsSkills = chFieldsSkills.idchFieldsSkills inner join catSkills on chFieldsSkills.idcatSkills = catSkills.idcatSkills inner join catCountries on t2.idcatCountry = catCountries.idcatCountries where catCountries.status = 1 and catSkills.status = 1 and chFieldsSkills.status =1 and chUserFieldsSkills.status = 1 and t1.status = 1 and t1.email = '".$objJson->email."' and chUsersLinked.status = 1 and t2.status = 1 group by L1,L3,L4,L5,L6; ";
        $this->OpenDB();
    		//$res = $this->bConnection->query("select t2.name as L1, group_concat(catSkills.name separator ',') as L2, catCountries.path as L3, t2.email as L4, t2.nickname as L5, t2.shotSystem as L6 from prodUsers as t1 inner join chUsersLinked on t1.idprodUsers = chUsersLinked.idUserSource inner join prodUsers as t2 on chUsersLinked.idUserLinked = t2.idprodUsers inner join chUserFieldsSkills on t2.idprodUsers = chUserFieldsSkills.idprodUsers inner join chFieldsSkills on chUserFieldsSkills.idchFieldsSkills = chFieldsSkills.idchFieldsSkills inner join catSkills on chFieldsSkills.idcatSkills = catSkills.idcatSkills inner join catCountries on t2.idcatCountry = catCountries.idcatCountries where catCountries.status = 1 and catSkills.status = 1 and chFieldsSkills.status =1 and chUserFieldsSkills.status = 1 and t1.status = 1 and t1.email = '".$objJson->email."' and chUsersLinked.status = 1 and chUsersLinked.request = 5 and t2.status = 1 group by L1,L3,L4,L5,L6; ");
        $res = $this->bConnection->query("select t2.name as L1, group_concat(distinct(catFields.name) separator ',') as L2, catCountries.path as L3, t2.email as L4, t2.nickname as L5, t2.shotSystem as L6 from prodUsers as t1 inner join chUsersLinked on t1.idprodUsers = chUsersLinked.idUserSource inner join prodUsers as t2 on chUsersLinked.idUserLinked = t2.idprodUsers inner join chUserFieldsSkills on t2.idprodUsers = chUserFieldsSkills.idprodUsers inner join chFieldsSkills on chUserFieldsSkills.idchFieldsSkills = chFieldsSkills.idchFieldsSkills inner join catSkills on chFieldsSkills.idcatSkills = catSkills.idcatSkills inner join catFields on chFieldsSkills.idcatFields = catFields.idcatFields inner join catCountries on t2.idcatCountry = catCountries.idcatCountries where catFields.status = 1 and catCountries.status = 1 and catSkills.status = 1 and chFieldsSkills.status =1 and chUserFieldsSkills.status = 1 and t1.status = 1 and t1.email = '".$objJson->email."' and chUsersLinked.status = 1 and chUsersLinked.request = 5 and t2.status = 1 group by L1,L3,L4,L5,L6; ");
    		$rows = array();
    		while($r = mysqli_fetch_assoc($res)) {
    			$rows[] = array_map('utf8_encode', $r);
    		}
    		$this->CloseDB();
    		return base64_encode(json_encode($rows));
    }

    public function updateUsersLinkedOwn($arg)
    {
      $objJson = json_decode(base64_decode($arg));
      $this->OpenDB();
      $this->bConnection->set_charset("utf8");
      $res = $this->bConnection->query("update chUsersLinked set request = 6 where chUsersLinked.idUserSource = (select prodUsers.idprodUsers as L1 from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$objJson->arg1."') and chUsersLinked.idUserLinked = (select prodUsers.idprodUsers as L2 from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$objJson->arg2."');");
      $this->CloseDB();
      return '1';
    }

    public function updateUsersLinkedLinked($arg)
    {
      $objJson = json_decode(base64_decode($arg));
      $this->OpenDB();
      $this->bConnection->set_charset("utf8");
      $res = $this->bConnection->query("update chUsersLinked set request = 6 where chUsersLinked.idUserLinked = (select prodUsers.idprodUsers as L1 from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$objJson->arg1."') and chUsersLinked.idUserSource = (select prodUsers.idprodUsers as L2 from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$objJson->arg2."');");
      $this->CloseDB();
      return '1';
    }

    public function getUserRequestOwn($arg){
        $objJson = json_decode(base64_decode($arg));
        $this->OpenDB();
    		$res = $this->bConnection->query("select t1.nickname as L1, t1.email as L2, t2.nickname as L3, t2.email as L4 from chUsersLinked inner join prodUsers as t1 on chUsersLinked.idUserSource = t1.idprodUsers inner join prodUsers as t2 on chUsersLinked.idUserLinked = t2.idprodUsers where chUsersLinked.status = 1 and chUsersLinked.request = 4 and t1.status = 1 and t1.email = '".$objJson->email."' and t2.status = 1;");
    		$rows = array();
    		while($r = mysqli_fetch_assoc($res)) {
    			$rows[] = array_map('utf8_encode', $r);
    		}
    		$this->CloseDB();
    		return base64_encode(json_encode($rows));
    }

    public function getUserRequestLink($arg){
        $objJson = json_decode(base64_decode($arg));
        $this->OpenDB();
    		$res = $this->bConnection->query("select t1.nickname as L1, t1.email as L2, t2.nickname as L3, t2.email as L4 from chUsersLinked inner join prodUsers as t1 on chUsersLinked.idUserLinked = t1.idprodUsers inner join prodUsers as t2 on chUsersLinked.idUserSource = t2.idprodUsers where chUsersLinked.status = 1 and chUsersLinked.request = 4 and t1.status = 1 and t1.email = '".$objJson->email."' and t2.status = 1;");
    		$rows = array();
    		while($r = mysqli_fetch_assoc($res)) {
    			$rows[] = array_map('utf8_encode', $r);
    		}
    		$this->CloseDB();
    		return base64_encode(json_encode($rows));
    }

    public function getUserFields($arg){
        $objJson = json_decode(base64_decode($arg));
        $this->OpenDB();
    		$res = $this->bConnection->query("select distinct(catFields.name) as L1 from prodUsers inner join chUserFieldsSkills on prodUsers.idprodUsers = chUserFieldsSkills.idprodUsers inner join chFieldsSkills on chUserFieldsSkills.idchFieldsSkills = chFieldsSkills.idchFieldsSkills inner join catFields on chFieldsSkills.idcatFields = catFields.idcatFields where catFields.status = 1 and chFieldsSkills.status = 1 and chUserFieldsSkills.status = 1 and prodUsers.status = 1 and prodUsers.email = '".$objJson->arg1."';");
    		$rows = array();
    		while($r = mysqli_fetch_assoc($res)) {
    			$rows[] = array_map('utf8_encode', $r);
    		}
    		$this->CloseDB();
    		return base64_encode(json_encode($rows));
    }

    public function getCountUserRequestOwn($arg){
        $objJson = json_decode(base64_decode($arg));
        $this->OpenDB();
    		$res = $this->bConnection->query("select count(t1.nickname) as L1 from chUsersLinked inner join prodUsers as t1 on chUsersLinked.idUserSource = t1.idprodUsers inner join prodUsers as t2 on chUsersLinked.idUserLinked = t2.idprodUsers where chUsersLinked.status = 1 and chUsersLinked.request = 4 and t1.status = 1 and t1.email = '".$objJson->email."' and t2.status = 1;");
        $row = $res->fetch_assoc();
        $strR = $row['L1'];
    		$this->CloseDB();
    		return $strR;
    }

    public function getCountUserRequestLink($arg){
        $objJson = json_decode(base64_decode($arg));
        $this->OpenDB();
    		$res = $this->bConnection->query("select count(t1.nickname) as L1 from chUsersLinked inner join prodUsers as t1 on chUsersLinked.idUserLinked = t1.idprodUsers inner join prodUsers as t2 on chUsersLinked.idUserSource = t2.idprodUsers where chUsersLinked.status = 1 and chUsersLinked.request = 4 and t1.status = 1 and t1.email = '".$objJson->email."' and t2.status = 1;");
        $row = $res->fetch_assoc();
        $strR = $row['L1'];
    		$this->CloseDB();
    		return $strR;
    }


    public function updateRequestStatus($arg)
    {
      $objJson = json_decode(base64_decode($arg));
      $this->OpenDB();
      $this->bConnection->set_charset("utf8");
      $res = $this->bConnection->query("update chUsersLinked set request = '".$objJson->arg3."' where idUserSource = (select prodUsers.idprodUsers as L1 from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$objJson->arg1."') and idUserLinked = (select prodUsers.idprodUsers as A1 from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$objJson->arg2."');");
      $this->CloseDB();
      return $objJson->arg3;
      //return "update chUsersLinked set request = '".$objJson->arg3."' where idUserSource = (select prodUsers.idprodUsers as L1 from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$objJson->arg1."') and idUserLinked = (select prodUsers.idprodUsers as A1 from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$objJson->arg2."');";
    }

    public function getUserCountLinked($arg)
    {
      $objJson = json_decode(base64_decode($arg));
      $this->OpenDB();
      $this->bConnection->set_charset("utf8");
      $res = $this->bConnection->query("select count(prodUsers.email) as L1 from chUsersLinked inner join prodUsers on chUsersLinked.idUserSource = prodUsers.idprodUsers where chUsersLinked.status = 1 and prodUsers.status = 1 and chUsersLinked.request in (4,5,6) and prodUsers.email = '".$objJson->arg1."'; ");
      $row = $res->fetch_assoc();
      $strR = $row['L1'];
      $this->CloseDB();
      return $strR;
    }


    public function setUsersMsg($arg){
      $objJson = json_decode(base64_decode($arg));
      $this->OpenDB();
      $this->bConnection->set_charset("utf8");
      $res = $this->bConnection->query("insert into chUsersMsg (idUserSource, idUserLinked, msg) values ((select idprodUsers from prodUsers where prodUsers.status=1 and prodUsers.email ='".$objJson->arg1."'),(select idprodUsers from prodUsers where prodUsers.status=1 and prodUsers.email ='".$objJson->arg2."'),'".$objJson->arg3."');");
      $this->CloseDB();
      return '1';
      //return "insert into chUsersLinked (idUserSource,idUserLinked) values ((select prodUsers.idprodUsers as L1 from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$objJson->arg1."'),(select prodUsers.idprodUsers as L1 from prodUsers where prodUsers.status = 1 and prodUsers.email = '".$objJson->arg2."'))";
      //return "insert into chUsersMsg (idUserSource, idUserLinked, msg) values ((select idprodUsers from prodUsers where prodUsers.status=1 and prodUsers.email ='".$objJson->arg1."'),(select idprodUsers from prodUsers where prodUsers.status=1 and prodUsers.email ='".$objJson->arg2."'),'".$objJson->arg3."');";
    }

    public function updateUserProfile($arg){
      $objJson = json_decode(base64_decode($arg));
      $this->OpenDB();
      $this->bConnection->set_charset("utf8");
      $res = $this->bConnection->query("select prodUsers.idprodUsers as L1 from prodUsers where status = 1 and email = '".$objJson->email."';");
      $row = $res->fetch_assoc();
      $resUser = $row['L1'];
      $this->CloseDB();
      $this->OpenDB();
      $this->bConnection->set_charset("utf8");
      $res = $this->bConnection->query("update chUserCountries set status = 2 where idprodUsers = '".$resUser."';");
      $this->CloseDB();
      $this->OpenDB();
      $this->bConnection->set_charset("utf8");
      $res = $this->bConnection->query("update chUserFieldsSkills set status = 2 where idprodUsers = '".$resUser."';");
      $this->CloseDB();
      $this->OpenDB();
  		$this->bConnection->set_charset("utf8");
  		$res = $this->bConnection->query("select catCountries.idcatCountries as L1 from catCountries where status = 1 and code = '".$objJson->country."';");
  		$row = $res->fetch_assoc();
  		$strR = $row['L1'];
  		$this->CloseDB();
      $this->OpenDB();
      $this->bConnection->set_charset("utf8");
      $res = $this->bConnection->query("update prodUsers set name='".$objJson->name."', idcatCountry='".$strR."', last='".$objJson->lastname."', nickname='".$objJson->nickname."', bio='".$objJson->bio."', yt='".$objJson->yt."', ig='".$objJson->ig."', vi='".$objJson->vi."' where email = '".$objJson->email."';");
      $this->CloseDB();
      return '1';
    }

    public function updateShotProfile($arg){
      $objJson = json_decode(base64_decode($arg));
      $this->OpenDB();
      $this->bConnection->set_charset("utf8");
      $res = $this->bConnection->query("update prodUsers set shotUser='".$objJson->arg3."', shotSystem='".$objJson->arg2."' where status = 1 and email = '".$objJson->arg1."';");
      $this->CloseDB();
      $file_to_search = $objJson->arg2;
      $dir='../uploads';
      $email = substr(basename($file_to_search),0,-57);
      $files = scandir($dir);
      foreach($files as $key => $value)
      {
        $realpath = $dir.DIRECTORY_SEPARATOR.$value;
        $path = realpath($realpath);
        if(!is_dir($path))
        {
          $rest = substr(basename($value),0,-57);
          if($email == $rest)
          {
            if($file_to_search != $value)
            {
              unlink($path);
            }
          }
        }
      }

      return 1;
      //return "update prodUsers set shotUser='".$objJson->arg3."', shotSystem='".$objJson->arg2."' where status = 1 and email = '".$objJson->arg1."';";
    }

}
?>
