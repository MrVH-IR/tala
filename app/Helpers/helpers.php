<?php


function formatPrice($price): string
{
    return number_format($price , 3 , '.' , ',');
}
