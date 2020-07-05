<?php
///////////////////////////// HBA GD Creation Graphs
///////////////////////////// Devloped by : Zakaria HBA
///////////////////////////// 2017-03-21 at 8:15am
///////////////////////////// zakaria.hba.97@gmail.com
///////////////////////////// HBA Corp.

///////////////////////////// constructor : p0=destinationName(file_name);p1=width;p2=height;p3=bgcolor(r,g,b)
///////////////////////////// set_axes : p0=padding(int);p1=color(r,g,b)
///////////////////////////// set_title : p0=title;$p1=$f_s;$p2=sizeofchars;$3=color(r,g,b)
//////////////////////////////////  $p1=$f_s: for decrease the line size (small lines at the end of each axe)

class HBA_GD{

public $img;
public $w,$h,$destination;

	public function __construct($destination, $w, $h, $bg){
		$this->img = imagecreate($w, $h);
		$this->w=$w;
		$this->h=$h;
		$this->destination=$destination;
		$bg = $this->get_color($bg);
	}

	public function get_color($col){
		$col = str_replace('#', '', $col);
		$col = str_split($col);
		for($i=0;$i<count($col);$i++){
			if(strtolower($col[$i])=="a") $col[$i]=10;
			if(strtolower($col[$i])=="b") $col[$i]=11;
			if(strtolower($col[$i])=="c") $col[$i]=12;
			if(strtolower($col[$i])=="d") $col[$i]=13;
			if(strtolower($col[$i])=="e") $col[$i]=14;
			if(strtolower($col[$i])=="f") $col[$i]=15;
		}
		$r = $col[0] + ($col[1]*16);
		$g = $col[2] + ($col[3]*16);
		$b = $col[4] + ($col[5]*16);
		return imagecolorallocate($this->img, $r, $g, $b);
	}

	public function set_axes($padding,$f_s, $line_color){
		$line_color = $this->get_color($line_color);
		///// les axes
		imageline($this->img, $padding, $this->h - $padding, $this->w - $padding, $this->h - $padding, $line_color);
		imageline($this->img, $padding, $padding, $padding, $this->h - $padding, $line_color);
		//// les fleches
		imageline($this->img, $this->w-$padding, $this->h-$padding, $this->w-$padding-floor($padding/$f_s), $this->h-$padding-floor($padding/$f_s), $line_color);
		imageline($this->img, $this->w-$padding, $this->h-$padding, $this->w-$padding-floor($padding/$f_s), $this->h-$padding+floor($padding/$f_s), $line_color);

		imageline($this->img, $padding+floor($padding/$f_s), $padding+floor($padding/$f_s), $padding, $padding, $line_color);
		imageline($this->img, $padding-floor($padding/$f_s), $padding+floor($padding/$f_s), $padding, $padding, $line_color);
	}

	public function set_title($title, $size, $r,$g,$b){
		$text_color = imagecolorallocate($this->img, $r, $g, $b);
	}

	public function Output(){
		imagejpeg($this->img, $this->destination.".jpg");
	}
}

?>