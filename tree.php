<?php
$input = 'A(B(CCC)B(CC))A(BB(C))AA(B(CCCCCC(DD(E(FFFF)))))AAAA(B(C(D(E(F)))))';

$root = fill(new Node("/"), $input, 'A');
$root->dump();


/**
 * Class Node
 * @property string $letter
 * @property Node[] $items
 */
class Node {
    public $letter;
    private $items = [];

    /**
     * Node constructor.
     * @param string $letter
     */
    public function __construct($letter) {
        $this->letter = $letter;
    }

    /**
     * @param Node $item
     */
    public function addItem($item) {
        $this->items[] = $item;
    }

    /**
     * @return string
     */
    public function __toString(){
        return $this->letter;
    }

    /**
     * @param int $level
     */
    public function dump($level = 0) {
        $level++;
        foreach ($this->items as $item){
            echo str_repeat("  ", $level).$item."\n";
            $item->dump($level);
        }
    }
}


/**
 * @param Node $root
 * @param string $input
 * @param string $letter
 * @return Node mixed
 */
function fill($root, $input, $letter){
    $pattern = "/({$letter}+)(\(.[^{$letter}]*\)|.*)/";
    preg_match_all($pattern, $input, $out);
    if ($out[0] && $out[1]){
        for($i=0; $i<sizeof($out[0]); $i++){

            // a few equal letters in line
            if (strlen($out[1][$i]) > 1){
                for ($n=1; $n<strlen($out[1][$i]); $n++){
                    $root->addItem(new Node($letter));
                }
            }

            $innerInput = $out[0][$i];
            $node = new Node($letter);
            $root->addItem($node);

            $nextLetter = $letter;
            $nextLetter++;

            fill($node, $innerInput, $nextLetter);
        }
    }
    else {
        for ($k=0; $k<substr_count($input, $letter); $k++){
            $root->addItem(new Node($letter));
        }
    }

    return $root;
}
