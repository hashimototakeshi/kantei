<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * ゼロ学
 * http://dictionary.sensagent.com/0%E5%AD%A6/ja-ja/
 * $zerogak = new zerogak();
 * print("anno". $zerogak->getZeroMainString(1986,6,10). "\n") ;
 * print("kurose". $zerogak->getZeroMainString(1984,4,13). "\n") ;
 * print("takeshi:". $zerogak->getZeroMainString(1970,8,13)."\n") ;
 * print("atsuko:". $zerogak->getZeroMainString(1970,3,30)."\n") ;
 * print("hanaka:".  $zerogak->getZeroMainString(2002,12,20) ."\n") ;
 * print("kanki:".   $zerogak->getZeroMainString(2005,2,13) ."\n") ;
 * print("rina:".   $zerogak->getZeroMainString(2006,7,18) ."\n") ;
 * 
 * print("takeshi:". $zerogak->getZeroString(1970,8,13)."\n") ;
 * print("atsuko:". $zerogak->getZeroString(1970,3,30)."\n") ;
 * print("hanaka:".  $zerogak->getZeroString(2002,12,20) ."\n") ;
 * print("kanki:".   $zerogak->getZeroString(2005,2,13) ."\n") ;
 * print("rina:".   $zerogak->getZeroString(2006,7,18) ."\n") ;
 * 
 */
class ZeroComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public $mainString = [
        '水王星', //（ 1-10 - 水王星（奇数年生まれ：氷王星、偶数年生まれ：水星）
        '土王星', //（ 11-20 - 土王星（奇数年生まれ：天王星、偶数年生まれ：土星）
        '金王星', //（ 21-30 - 金王星（奇数年生まれ：小王星、偶数年生まれ：金星）
        '火王星', //（ 31-40 - 火王星（奇数年生まれ：冥王星、偶数年生まれ：火星）
        '月王星', //（ 41-50 - 月王星（奇数年生まれ：魚王星、偶数年生まれ：月星）
        '木王星', //   51-59、0 - 木王星（奇数年生まれ：海王星、偶数年生まれ：木星）
    ];
    public $zeroString = [
        [
            'name' => '氷王星', //（ 1-10 - 水王星（奇数年生まれ：氷王星、偶数年生まれ：水星）
            'description'=>'誰とでも笑顔で接し、人懐こさで人気者。状況を把握し流れに乗る力がある。会話上手で世話好き',
        ],[
            'name' => '水星', //（ 1-10 - 水王星（奇数年生まれ：氷王星、偶数年生まれ：水星）
            'description'=>'ポジティブ思考でエネルギッシュ。幅広い行動力。人と交流することが大好き。お金の扱いに長けている',
        ],[
            'name' => '天王星', //（ 11-20 - 土王星（奇数年生まれ：天王星、偶数年生まれ：土星）
            'description'=>'エレガントさがある。真面目で手抜きせず物事に取り組む。強い精神と持久力がある。強い向上心がある',
        ],[
            'name' => '土星', //（ 11-20 - 土王星（奇数年生まれ：天王星、偶数年生まれ：土星）
            'description'=>'優雅で品の良さを持つ。正義感が強く包容力がある。決断心、先をみる判断力がある',
        ],[
            'name' => '小王星', //（ 21-30 - 金王星（奇数年生まれ：小王星、偶数年生まれ：金星）
            'description'=>'小さなことでクヨクヨしない楽天家、マイペースを保ち精一杯のことをする。気持ちの切り換えが早い。流行を先取りできる鋭い感覚',
        ],['name' => '金星', //（ 21-30 - 金王星（奇数年生まれ：小王星、偶数年生まれ：金星）
            'description'=>'幅広く行動できる。新鮮な情報をキャッチする力がある。無邪気で人当たりがソフト。果敢に物事をスタートさせるチャレンジ精神',
        ],[
            'name' => '冥王星', //（ 31-40 - 火王星（奇数年生まれ：冥王星、偶数年生まれ：火星）
            'description'=>'冷静沈着。人の意見に左右されない強い信念がある。マイペースを保って着実に前進',
        ],[
            'name' => '火星', //（ 31-40 - 火王星（奇数年生まれ：冥王星、偶数年生まれ：火星）
            'description'=>'知的で繊細さがある。何事に対しても慎重に取り組む。伝統や常識を重んじる。弱音を吐かない忍耐強さ',
        ],[
            'name' => '魚王星', //（ 41-50 - 月王星（奇数年生まれ：魚王星、偶数年生まれ：月星）
            'description'=>'すべての人に対して優しさと思いやりを持つ。誰かに尽くして自らの喜びを得られる。誰かを支えまたは支えられて安定',
        ],[
            'name' => '月星', //（ 41-50 - 月王星（奇数年生まれ：魚王星、偶数年生まれ：月星）
            'description'=>'為に尽くそうとする正義感がある。奉仕精神を強く持つ。頼れる人がいてこそ生き生きできる',
        ],[
            'name' => '海王星', //   51-59、0 - 木王星（奇数年生まれ：海王星、偶数年生まれ：木星）
            'description'=>'マイペースで努力家、効率を考えて行動する慎重派。こだわりへの追求心が旺盛。古風な考えを持ち合わせる',
        ],[
            'name' => '木星', //   51-59、0 - 木王星（奇数年生まれ：海王星、偶数年生まれ：木星）
            'description'=>'真面目で要領が良い。冷静な判断力、警戒心を持つ。物事の慎重な取り組み、計画遂行力がある。仕事と家庭を両立できる器用さがある',
        ],
    ];
    public $lifeStep = [
        ['name' => '背信期', 'description' =>'寒さを耐え忍ぶ冬の時期。信頼や期待を裏切られやすく、環境の変化に戸惑い易い時期。予期せぬ出来事に慌てず、守りを固くして受け身で過ごすことが大切。勢いにはブレーキをかけ環境に馴染み、現状維持を心がける'],
        ['name' => '0地点',  'description' =>'真冬の運命期。苦手とすることを求められ、欠点が露わになる。もがくほど深みにハマり、意のままに動けないもどかしさに苦しむが、裏を返せば自分の新たな一面を発見できる時。不得意な面を克服するチャンスの時期でもある'],
        ['name' => '精算期', 'description' =>'少しづつ春の気配が近づくとともに、変化が起こり始める。自分の意に反し、人の手によって何かを変えられる場合も。執着せず新しい運気を迎え入れる潔さが必要。油断せず先々の計画を練り、春に備えて準備をする時期'],
        ['name' => '開拓期', 'description' =>'守りの冬から攻めの春に衣替え。温めていた計画に向かって、積極的に動き出そう。前を向いて進むうちに新しい出会いや興味が広がり活気づいてくる。何事にも果敢に挑戦して視野を広げる時期'],
        ['name' => '生長期', 'description' =>'くさきが栄養分を吸収するように、未知の分野があっても果敢に飛び込んで刺激を受けて欲しい時期。たとえ失敗しても、再起できる気力と体力がある。行動的になることによって新しい友人や異性との縁も増え、次に繋がるチャンスが増える'],
        ['name' => '決定期', 'description' =>'夏期に花を咲かせられるかは、この時期の選択にかかっている。今後、運命期の7年間を決定づける大切な時期。自分にとってベストなスタイルを見つけ、目標むけて集中することで発展していく。早めに上昇気流に乗れるよう目的を探すこと'],
        ['name' => '健康期', 'description' =>'梅雨を思わせる運気が勢いづいた気力を萎えさす。心身ともに無理をすればトラブルや事故のもとに。本格的な夏の運気を迎える前に、起きた問題を誠実に処理し、気がかりを減らして大輪の花を咲かせるための準備をしていこう'],
        ['name' => '人気期', 'description' =>'太陽の光を浴びて、これまでの努力が開花してくる。自身の魅力も高まり、注目を集める存在に。ただし努力を怠ったり、やり方を間違えてきた人にとっては喜ばしくない花が咲くことも。今までの経緯に沿った結果が出てくる'],
        ['name' => '浮気期', 'description' =>'気は緩み、やるべきことに身が入らない時期。人気期に好調だった人ほど、落とし穴にはまりやすいので注意が必要。また軽率な行動で評価や成果を落としてしまうと、秋期の収穫が減ることに。何事も謙虚な気持ちで過ごすことが重要'],
        ['name' => '再開期', 'description' =>'初秋の心地よさに活力が戻ってきます。目的を果たせなかった、または評価を落としてしまった人には再起のチャンス。過去に培った経験を活かすことが重要で、新規のものには花は咲きません。開拓期以降に縁があったものに注目しよう'],
        ['name' => '経済期', 'description' =>'収穫の秋が到来。開拓期から努力してきた人には社会的評価が上がり、経済が潤ってくる。ただし浪費は禁物。冬期を安心して過ごすための余力を残すことが重要。実りの秋ゆえに多忙を極めますが、気力が十分なため乗り越えていける'],
        ['name' => '充実期', 'description' =>'精神、物質ともに満たされ運気のクライマックスを迎える。最高の状態だけに新たに得られるものはなく、冬期に向けての準備が鍵。状況に浮かれることなく、未解決の問題は冬を迎える前に解決しておくことが重要'],
    ];
    public function getLifeSteps()
    {
        return $this->lifeStep;
    }
    public function getDestinyTime($zeroNum)
    {
        //氷王星がいる場所0から数える
        $diff = (int)date('Y') - 2020;
        $diff %= 12;
        $lifeStepId = $diff + $zeroNum;
        $lifeStepId %= 12; 
        return $lifeStepId;
    }
    public function getZero(String $dob):Array
    {
        $year = date('Y', strtotime($dob));
        $month = date('m', strtotime($dob));
        $day = date('d', strtotime($dob));
        $zeroNum = $this->getZeroNum($year, $month, $day);
        $ret = $this->zeroString[$zeroNum];
        $ret['destinyNum'] = $this->getDestinyTime($zeroNum);
        $ret['destiny'] = $this->lifeStep[$this->getDestinyTime($zeroNum)]['name'];
        return $ret;
    }
    public function getZeroString($year, $month, $day)
    {
        return $this->zeroString[$this->getZeroNum($year, $month, $day)]['name'];   
    }
    public function getZeroMainString($year, $month, $day)
    {
         $zero_type = $this->getZeroMainType($year, $month, $day);
         return $this->mainString[$zero_type];
    }
    function getZeroNum($year, $month, $day)
    {
        $zero_type = $this->getZeroMainType($year, $month, $day);
        $youin = $year % 2;
        return $zero_type * 2 + 1 - $youin;   
    }
    function getZeroMainType($year, $month, $day){
        $type_num = (cal_to_jd( CAL_GREGORIAN,  (int)$month, (int)$day, (int)$year ) % 60);
        if ($type_num > 50 || $type_num == 0){
            return 5;
         }else if( $type_num > 40){
             return 4;
         }else if( $type_num > 30){
             return 3;
         }else if( $type_num > 20){
             return 2;
         }else if( $type_num > 10){
             return 1;
         }else{
             return 0;
         }
    }
}
