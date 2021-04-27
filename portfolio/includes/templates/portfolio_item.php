<?php

function array_combine_($keys, $values) {
    $result = array();

    foreach ($keys as $i => $k) {
        $result[$k][] = $values[$i];
    }

    array_walk($result, function (&$v) {
        $v = (count($v) == 1) ? array_pop($v): $v;
    });

    return $result;
}

class Item {
    public $id;
    public $title;
    public $desc;
    public $date;
    public $client;
    public $thumb = array('');
    public $keys = array('');
    public $link = array('');
    public $array;

    public function setID($par) {
        $this->id = $par;
    }
    public function setTitle($par) {
        $this->title = $par;
    }
    public function setDesc($par) {
        $this->desc = $par;
    }
    public function setDate($par) {
        $this->date = $par;
    }
    public function setClient($par, $desc) {
        $this->client = $par . ' ' . $desc;
    }

    public function setLink($par, $bool, $id) {
        $this->thumb[$bool] = $par;
        if ($bool != 1) {
            array_push($this->link, $par);
            array_push($this->keys, $id);
        }
    }

    public function printItem($id) {
        $this->array = array_combine_($this->keys, $this->link);

        echo '<a id="'. $this->id .'itemClick" class="ui fluid link card">
                <div class="ui slide masked image">
                  <img src="' . $this->thumb[1] . '" class="visible content">
                </div>
                <div class="content">
                  <div class="header"> ' . $this->title . '</div>
                  <div class="meta">
                    <span class="date">' . $this->date . '</span>
                  </div>
                  <div class="description">
                    <span class="date">' . $this->desc . '</span>
                  </div>
                </div>
                <div class="extra content">
                  <div>
                    <i class="address book outline icon"></i>
                    ' . $this->client . '
                  </div>
                </div>
              </a>';
        echo '<div id="'. $this->id .'modal" class="ui modal">
               <i class="close icon"></i>
               <div class="content">
                 <div class="ui items">
                  <div class="item">
                    <div class="image">
                      <img src="' . $this->thumb[1] .' ">
                    </div>
                    <div class="content">
                      <a class="header">' . $this->title . '</a>
                      <div class="meta">
                        <span>' . $this->desc . '</span>
                      </div>
                      <div class="description">
                        <p>' . $this->desc . '</p>
                      </div>
                      <div class="extra">
                        Made for ' . $this->client . '
                      </div>
                    </div>
                  </div>
                </div>
                <div class="ui divider"></div>
                <div class="">
                  <div class="ui left aligned container">';

                  if (array_key_exists($id, $this->array)) {
                    if (is_array($this->array[$id])) {
                        for ($i=0; $i < count($this->array[$id]); $i++) {
                            echo '<div class="">';
                            print_r('<img class="zoom" tyle="width:100%" src="' . $this->array[$id][$i] . '">');
                            echo '</div>';
                        }
                    } else {
                        print_r('<img class="zoom" style="width:100%" src="' . $this->array[$id] . '">');
                    }
                  }

        echo '</div>
              </div>
              </div>
              </div>';
    }
}
