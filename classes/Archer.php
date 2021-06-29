<?php

class Archer extends Character {

    public $quiver = 10;
    public $arrow = 1;
    public $multiplier = 1;

    public function turn($target) {
        if ($this->quiver > 0) {
            $rand = rand(1, 3);
            if ($rand == 2 && $this->quiver >= 2 && $this->arrow != 2) {
                $this->arrow = 2;
                $status = "$this->name encoche une seconde flèche et se prépare à tirer.";
                return $status;
            }else if ($rand == 3) {
                $up = rand(15, 30)/10;
                $this->multiplier *= $up;
                $status = "$this->name prend le temps de viser un point faible de $target->name.";
                return $status;
            } else {
                return $this->bowShot($target);
            }
        } else {
            return $this->dagger($target);
        }
    }

    public function dagger($target) {
        $dagger = $this->damage / 3;
        $target->setHealthPoints($dagger);
        $status = "$this->name n'as plus de flèche et attaque à la dague ! Il inflige $dagger dégâts à $target->name ! Il reste $target->healthPoints points de vie à $target->name";
        return $status;
    }

    public function bowShot($target) {
        $c = 0;
        for ($i = $this->arrow; $i > 0; $i--) {
            $target->setHealthPoints($this->damage * $this->multiplier);
            $c++;
        }
        $status = "$this->name tire $c flèches ! Il reste $target->healthPoints points de vie à $target->name.";
        $this->arrow = 1;
        $this->multiplier = 1;
        $this->quiver -= $c;
        return $status;
    }
}