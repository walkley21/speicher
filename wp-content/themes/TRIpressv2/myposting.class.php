<?php 
/*depends on dom.php */

class MyPosting
{
	protected $mls; 
	protected $feedid;
	protected $page;
	protected $html;
	protected $site; // the idx site to get info from 
        protected $found = true;
	function __construct($mls,$feedid)
	{
            
                //echo "MLS[$mls]";
                $this->mls = $mls;
            
		if (!empty($mls))
		{
                    $this->mls    = $mls;
                    $this->feedid = $feedid;
                    $this->site = site_url()."/idx/mls-$mls-";

                    $this->html = file_get_html($this->site);
                    //echo "[$this->html]";
                    sleep(0.05);//give time to the html to be loaded;
                    
                    $notfound = $this->html->getElementById("not-found-dsidx");
                    if (!empty($notfound))
                    {   $this->mls = null;
                        $this->found = false;
                        return;
                    }
                    
                }
                else
                {
                    //echo "no mls provided";
                }
	}
	function getMainImage($size)
	{
		$f = $this->getImages($onlyFirst = true);	
		return '<img style="vertical-align:top" width="'.$size.'" src="'.$f.'"/>';
	}
	function getGallery($cols=16)
	{
		if (empty($this->mls))
                return;    
                    
		$images = $this->getImages();
                if (empty($images))return;    
		$imagesMatrix = array_chunk($images,$cols);
		$string = '';
		$string = '<table border="0" align="center">';
		foreach($imagesMatrix as $row)
		{
			$string.= '<tr>';
			foreach($row as $col)
			{
				$string.= '<td >';				
				$string.='<a href="'.site_url().'/idx/mls-'.$this->mls.'-" target="_blank">';
				$string.='<img style="border:none;" src="'.$col.'"   onerror="imgError(this);" />';				
				$string.='</a>';
				$string.= '</td>';				
					
			}
			$string.='</tr>';
		}
		$string.='</table>';
		return $string;
	}	
	

	function getImages($first=false)
	{
                if(empty($this->mls))
                return;    
                
				if ($first)
				{
					return "http://2.idx-pics.diverse-cdn.com/{$this->feedid}/{$this->mls}/0-full.jpg";
				}
					
					
				for($i=0; $i<20;$i++)
				{
						$imageUrl = "http://2.idx-pics.diverse-cdn.com/{$this->feedid}/{$this->mls}/{$i}-tiny.jpg";

						$array[]= $imageUrl;
				}
                return $array;
                 
	}
	
	function getDescription($content=null)
	{
                if (empty($content))
                {
                    if(!empty($this->mls))
                    {    
                        return $this->html->getElementById("dsidx-description-text");
                    }
                }    
		
                else
                return $content;
                    
	}
	
	
	function getPrice($price=null)
	{
                if (empty($this->mls) and !(empty($price)))
                {
                    return '$'.number_format($price);
                }
                else if(!empty($this->mls))
		$price = $this->html->getElementById("dsidx-primary-data")->find('td',0)->innertext;
		
		return trim($price);
		
	}
	function getStatus($value=null)
	{
            
                if (empty($this->mls))
                {
                    return $value;
                }
            
		$status = $this->html->getElementById("dsidx-primary-data")->find('td',1)->innertext;
		
		return trim($status);
		
	}
	function getBeds($beds=null)
	{
                if (empty($this->mls))
                {
                    return $beds;
                }
            
            
		$val = $this->html->getElementById("dsidx-primary-data")->find('td',2)->innertext;
		//echo "[val is $val ]";
		return trim($val);
		
	}
	
	function getBaths($value=null)
        {
                if (empty($this->mls))
                {
                    return $value;
                }
                
            
		$val = $this->html->getElementById("dsidx-primary-data")->find('td',3)->innertext;
		//echo "[val is $val ]";
		return trim($val);
		
	}
	
	function getSqFeet($value=null)
	{
                if (empty($this->mls))
                {
                    return $value;
                }
            
		$val = $this->html->getElementById("dsidx-primary-data")->find('td',5)->innertext;
		//echo "[val is $val ]";
		return trim($val);
		
	}
	function getHouseSqFeet($value=null)
	{
            
                if (empty($this->mls))
                {
                    return $value;
                }
            
		$val = $this->html->getElementById("dsidx-primary-data")->find('td',4)->innertext;
		//echo "[val is $val ]";
		return trim($val);
		
	}
	
	
	function getYearBuilt($value=null)
	{
                if (empty($this->mls))
                {
                    return $value;
                }
            
		$val = $this->html->getElementById("dsidx-secondary-data")->find('td',2)->innertext;
		//echo "[val is $val ]";
		return trim($val);
		
	}
	function getGarages($value=null)
	{



                if (empty($this->mls))
                {
                    return $value;
                }

            
		$sec = $this->html->getElementById("dsidx-secondary-data");
		if ($sec)
		{
			$garage = $sec->find("tr",2)->find("td",0);		
			if ($garage)
			{
				$val =$garage->text();
			}
		}

		
		 
		 
		 
		return trim($val);
		
		
	}
        
        function Found()
        {
           return $this->found;
        }
        
	function getAddress($post_address=null)
	{
            
                if ($this->found == false)
                {
                    return "Property Not Found";
                }
            
            
                if (empty($this->mls))
                {
                   return $post_address; 
                }
            
		/*two sites returned the name on different dom elements*/
		$val = $this->html->getElementsByTagName("h2",0)->innertext;
		//echo "[val is $val ]";
		//print_R($val);
		return trim($val);	
	}
	
	function getCounty($value=null)
	{
                if (empty($this->mls))
                {
                    return $value;
                }
            
		$val = $this->html->getElementById("dsidx-secondary-data")->find('td',5)->innertext;
		//echo "[val is $val ]";
		return trim($val);
	}
	function getZipcode($value=null)
	{
                if (empty($this->mls))
                {
                    return $value;
                }
            
		$val = $this->html->getElementById("dsidx-secondary-data")->find('td',3)->innertext;
		//echo "[val is $val ]";
		return trim($val);
	}
	function getState($value)
	{
                if (empty($this->mls))
                {
                    return $value;
                }
            
            
		$val = $this->html->getElementById("dsidx-secondary-data")->find('td',3)->innertext;
		//echo "[val is $val ]";
		return trim($val);
	}
        
        function safe_mailto($email, $title = '', $attributes = '')
	{
		$title = (string) $title;

		if ($title == "")
		{
			$title = $email;
		}

		for ($i = 0; $i < 16; $i++)
		{
			$x[] = substr('<a href="mailto:', $i, 1);
		}

		for ($i = 0; $i < strlen($email); $i++)
		{
			$x[] = "|".ord(substr($email, $i, 1));
		}

		$x[] = '"';

		if ($attributes != '')
		{
			if (is_array($attributes))
			{
				foreach ($attributes as $key => $val)
				{
					$x[] =  ' '.$key.'="';
					for ($i = 0; $i < strlen($val); $i++)
					{
						$x[] = "|".ord(substr($val, $i, 1));
					}
					$x[] = '"';
				}
			}
			else
			{
				for ($i = 0; $i < strlen($attributes); $i++)
				{
					$x[] = substr($attributes, $i, 1);
				}
			}
		}

		$x[] = '>';

		$temp = array();
		for ($i = 0; $i < strlen($title); $i++)
		{
			$ordinal = ord($title[$i]);

			if ($ordinal < 128)
			{
				$x[] = "|".$ordinal;
			}
			else
			{
				if (count($temp) == 0)
				{
					$count = ($ordinal < 224) ? 2 : 3;
				}
	
				$temp[] = $ordinal;
				if (count($temp) == $count)
				{
					$number = ($count == 3) ? (($temp['0'] % 16) * 4096) + (($temp['1'] % 64) * 64) + ($temp['2'] % 64) : (($temp['0'] % 32) * 64) + ($temp['1'] % 64);
					$x[] = "|".$number;
					$count = 1;
					$temp = array();
				}
			}
		}

		$x[] = '<'; $x[] = '/'; $x[] = 'a'; $x[] = '>';

		$x = array_reverse($x);
		ob_start();

	?><script type="text/javascript">
	//<![CDATA[
	var l=new Array();
	<?php
	$i = 0;
	foreach ($x as $val){ ?>l[<?php echo $i++; ?>]='<?php echo $val; ?>';<?php } ?>

	for (var i = l.length-1; i >= 0; i=i-1){
	if (l[i].substring(0, 1) == '|') document.write("&#"+unescape(l[i].substring(1))+";");
	else document.write(unescape(l[i]));}
	//]]>
	</script><?php

		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}
}