<?php
interface IRender{
    public function render(callable $callback):string;
}