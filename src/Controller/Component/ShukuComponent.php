<?php
namespace App\Controller\Component;

use Cake\Controller\Component;

class ShukuComponent extends Component
{
    public $components = ['Qreki'];

    public function getShuku($targetDate = null)
    {
        if (empty($targetDate)){
            $targetDate = date('Y-m-d');
        }
        $target = strtotime($targetDate);
        $kyureki = $this->Qreki->calc_kyureki(date('Y',$target), date('m', $target), date('d',$target));
        /*
         * kyureki[0] : 旧暦年
         * kyureki[1] : 平月／閏月 flag .... 平月:0 閏月:1
         * kyureki[2] : 旧暦月
         * kyureki[3] : 旧暦日
         */
        $shuku = $this->getShukuId( $kyureki[2], $kyureki[3]);
      return $this->syukuyo[$shuku];
    }
    public $syukuyo = [ //{{{
        ['name' => '昴宿','yomi'=>'ぼうしゅく','description'=>'気高くコツ育ち、研究熱心。気品の人'],
        ['name' => '畢宿','yomi'=>'ひつしゅく','description'=>'コツコツ、大器晩成、庶民感覚の人'],
        ['name' => '觜宿','yomi'=>'ししゅく'  ,'description'=>'財運、学識ある雄弁家'],
        ['name' => '参宿','yomi'=>'しんしゅく','description'=>'新発想で時代を変えるアイディアマン'],
        ['name' => '井宿','yomi'=>'せいしゅく','description'=>'真面目で優しい理性の人'],
        ['name' => '鬼宿','yomi'=>'きしゅく'  ,'description'=>'純真で楽天的な自由人'],
        ['name' => '柳宿','yomi'=>'りゅうしゅく','description'=>'燃える女、熱い男。正義の人'],
        ['name' => '星宿','yomi'=>'せいしゅく', 'description'=>'自分流。渋い、個性の人'],
        ['name' => '張宿','yomi'=>'ちょうしゅく','description'=>'理想が高く、話し上手な大輪の花'],
        ['name' => '翼宿','yomi'=>'よくしゅく','description'=>'自分は自分。清く正しく生きていく'],
        ['name' => '軫宿','yomi'=>'しんしゅく','description'=>'機転が利き、行動が早い、趣味の人'],
        ['name' => '角宿','yomi'=>'かくしゅく','description'=>'天真爛漫、人徳ある優等生'],
        ['name' => '亢宿','yomi'=>'こうしゅく','description'=>'気骨のある意思の強い、正義の人'],
        ['name' => '氏宿','yomi'=>'ていしゅく','description'=>'豪快で勘の良い大親分'],
        ['name' => '房宿','yomi'=>'ぼうしゅく','description'=>'魅力的、財運ある舞台で光る人'],
        ['name' => '心宿','yomi'=>'しんしゅく','description'=>'愛嬌、人気抜群、役者星'],
        ['name' => '尾宿','yomi'=>'びしゅく', 'description'=>'実直、一本気、本物志向のしごと人'],
        ['name' => '箕宿','yomi'=>'きしゅく', 'description'=>'度胸、正直、やんちゃな暴れん坊'],
        ['name' => '斗宿','yomi'=>'としゅく', 'description'=>'カリスマ性、闘魂持つ、元祖'],
        ['name' => '女宿','yomi'=>'じょしゅく','description'=>'野心、政治力、影のボス'],
        ['name' => '虚宿','yomi'=>'きょしゅく','description'=>'良い勘、責任感、勝負師の星'],
        ['name' => '危宿','yomi'=>'きしゅく','description'=>'おしゃれ、直感力、芸術家'],
        ['name' => '室宿','yomi'=>'しつしゅく','description'=>'正直で商才ある、超大物'],
        ['name' => '壁宿','yomi'=>'へきしゅく','description'=>'不言実行、頑固一徹、長寿の人'],
        ['name' => '奎宿','yomi'=>'けいしゅく','description'=>'セレブ育ち、プライド高い、夢追人'],
        ['name' => '婁宿','yomi'=>'ろうしゅく','description'=>'オールマイティ、容姿端麗、気配りの人'],
        ['name' => '胃宿','yomi'=>'いしゅく','description'=>'反骨精神、シャープな、実行派'],
    ]; //}}}

    function getShukuId($qmon,$qday){
      $suku=0;
      if    ($qmon ==  1) { $suku = $qday + 21; }
      elseif ($qmon ==  2) { $suku = $qday + 23; }
      elseif ($qmon ==  3) { $suku = $qday + 25; }
      elseif ($qmon ==  4) { $suku = $qday     ; }
      elseif ($qmon ==  5) { $suku = $qday +  2; }
      elseif ($qmon ==  6) { $suku = $qday +  4; }
      elseif ($qmon ==  7) { $suku = $qday +  7; }
      elseif ($qmon ==  8) { $suku = $qday + 10; }
      elseif ($qmon ==  9) { $suku = $qday + 12; }
      elseif ($qmon == 10) { $suku = $qday + 14; }
      elseif ($qmon == 11) { $suku = $qday + 17; }
      elseif ($qmon == 12) { $suku = $qday + 19; }
  
      while ($suku >= 27){
        $suku -= 27;
      }
      return $suku;
    }
}

