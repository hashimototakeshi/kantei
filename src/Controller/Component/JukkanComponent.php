<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;

/**
 * 十干を陽暦（グレゴリウス暦）から求める方法となります
 *
 * @see http://www.tadopika.net/fate/tendaycount.html
 *
 * $jukkan = new jukkan( "2012-01-01");
 * echo  "A:" . $jukkan->getA();
 * echo  "/ B1:" . $jukkan->getB1();
 * echo  "/ B2:" . $jukkan->getB2();
 * echo  "/ B3:" . $jukkan->getB3();
 * echo  "/ C:" . $jukkan->getC();
 * echo  "/ D:" . $jukkan->getD() . "\n";
 * echo $jukkan->getJukkan();
 * echo $jukkan->getJukkan("1879-03-14");
 * echo $jukkan->getJukkan("3012-08-18");
 * echo $jukkan->getJukkan("1970-08-13");
 */
class JukkanComponent extends Component
{
    private $dob;
    private $kanshi = [
        ['name' => '甲','yomi' => 'きのえ','description' => '何事に対してもいい加減に済ます事ができず、人生に対して真剣に取り組む哲学を持っている。現状に常に不満を抱き一生懸命頭を働かせ何事も工夫して理想を目指す人。プライドが高く、人から命令口調で言われることを嫌うので人前で叱ってはいけない。権威には弱い。お願い口調で依頼すると気分よくやってくれる。'],
        ['name' => '乙','yomi' => 'きのと','description' => '人と人はお互いに協力し合って理想を追求していくべきだという協調の精神がある。他人のことを決して悪く言わず、相手の気持ちを推し量りながら細やかな気配りのでできる人。甲についでプライドが高い。傷つきやすい。芯がきつい。自分が責任を持つ'],
        ['name' => '丙','yomi' => 'ひのえ','description' => '一度やると決めたら寝食を忘れるほど没頭する強い集中力。やるか、やらないかのどちらかで、決めたら100％のエネルギーを注ぎ込んで努力する人。見栄を張りやすい。華やかさ、目立つ環境を求める。不正に関与できない。心変わりしやすい。強引に物事をすすめる'],
        ['name' => '丁','yomi' => 'ひのと','description' => '何気なく毎日を過ごすのではなく、世の中に役立つ人間になるために燃えたぎるような情熱。人のためになるような仕事に出会えれば迷いが消え、一つの目標に向かって突き進むことができる人。人を見る目は鋭い。好き嫌いがはっきり。正義感'],
        ['name' => '戊','yomi' => 'つちのえ','description' => '人間関係をとても大事にする。人と人の間の信頼を何よりも強く求めるので、一度交わした約束は絶対に最後まで守り通す一本筋の通った生き方を理想とする人。勇猛果敢。スパイをしてでも実行する'],
        ['name' => '己','yomi' => 'つちのと','description' => '愛情のない世界は考えられず、心の触れ合う人間関係を何より強く求める。表面的な人付き合いではなく、みんなが一つの家族のように親しくなれる、アットホームな付き合い方を理想とする人。仕事より家庭。理屈より感情を優先。ロマン思考'],
        ['name' => '庚','yomi' => 'かのえ','description' => 'アクティブで何か新しい刺激を受けると、即実行に移す思い切りの良い行動力を持っている。普通の人が人目を気にして、とても出来ないと思っていることでも平気でやってのける度胸と実行力がある人。自分が一番。この人は褒めてあげると動く'],
        ['name' => '辛','yomi' => 'かのと','description' => 'お金儲けや生活のためではなく、純粋に世のため人のために役に立ちたいというボランティア精神。自分の労働に対して与えられる報酬はお金より感謝の言葉であり、精神的な満足感を得られることを何より望む人。傷つきやすい。嘘ごまかしはNG。'],
        ['name' => '壬','yomi' => 'みずのえ','description' => '自ら進んで難しいテーマに取り組み、常に自分を高めることを怠らない強い向上心を持つ。安楽な道を歩むより、人生を闘いの場として捉え、毎日精神尽き果てるまで努力し続けることを理想とする人。知性的。戦略的思考。明確な指示を求める。'],
        ['name' => '癸','yomi' => 'みずのと','description' => '慎重で着実な計画性を持って豊かな世界を作り上げていく挑戦心を内に秘めている。その場のノリや雰囲気に流されることなく、常に情報を集め、何事も自分の頭で考え抜きながら人生を生きる人。頑固。人の話は聞いていない。クレーム処理は得意。'],
    ];

    function __construct($dob)
    {
        $this->dob = $dob;
    }

    function getA($dob = null)
    {
        if (empty($dob)) {
            $dob = $this->dob;
        }
        if (date('Y', strtotime($dob)) % 2 == 0) {
            return 0;
        }

        return 5;
    }

    function getB($dob = null)
    {
        if (empty($dob)) {
            $dob = $this->dob;
        }
        $month = date('n', strtotime($dob));
        if ($month == 2 || $month == 1) {
            return (int)((date('Y', strtotime($dob)) - 1 - 1900) / 400);
        } else {
            return (int)((date('Y', strtotime($dob)) - 1900) / 400);
        }
    }

    function getC($dob = null)
    {
        if (empty($dob)) {
            $dob = $this->dob;
        }
        $month = date('n', strtotime($dob));
        switch ($month) {
            case 3:
                return 8;
            break;
            case 1:
            case 4:
            case 5:
                return 9;
            break;
            case 2:
            case 6:
            case 7:
                return 0;
            break;
            case 8:
                return 1;
            break;
            case 9:
            case 10:
                return 2;
            break;
            case 11:
            case 12:
                return 3;
            break;
        }
    }

    function getD($dob = null)
    {
        if (empty($dob)) {
            $dob = $this->dob;
        }

        return date('j', strtotime($dob));
    }

    /**
     * 4年ごとのうるう年の調整
     */
    function getB1($dob = null)
    {
        if (empty($dob)) {
            $dob = $this->dob;
        }
        $month = date('n', strtotime($dob));
        if ($month == 2 || $month == 1) {
            return (int)((date('Y', strtotime($dob)) - 1) / 4 );
        } else {
            return (int)(date('Y', strtotime($dob)) / 4);
        }
    }

    /**
     * 100年ごとのうるう年の調整
     */
    function getB2($dob = null)
    {
        if (empty($dob)) {
            $dob = $this->dob;
        }
        $month = date('n', strtotime($dob));
        if ($month == 2 || $month == 1) {
            return (int)((date('Y', strtotime($dob)) - 1) / 100);
        } else {
            return (int)(date('Y', strtotime($dob)) / 100);
        }
    }

    /**
     * 400年ごとのうるう年の調整
     */
    function getB3($dob = null)
    {
        return (int)($this->getB1($dob) / 100);
    }

    function getJukkan($dob = null)
    {
        if (empty($dob)) {
            $dob = $this->dob;
        } else {
            $this->dob = $dob;
        }
        $sum = $this->getA() + $this->getB1() - $this->getB2()
            + $this->getB3() + $this->getC() + $this->getD();

        return $this->kanshi[$sum % 10];
    }
}
