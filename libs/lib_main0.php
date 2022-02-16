<?php
DEFINE ('NL', "\n");
DEFINE ('BR', "<br/>\n");
DEFINE ('INP_SIZE', 20);

function Info( $txt )
// Display text in green
{
    if ( $txt != '' ) echo "<p class=\"info\">$txt</p>";
}

function Warning( $txt )
// Display text in brown
{
    if ( $txt != '' ) echo "<p class=\"warning\">$txt</p>";
}

function Error( $txt )
// Display text in red
{
    if ( $txt != '' ) echo "<p class=\"error\">$txt</p>";
}

// echo $label; var_dump( $x ) in <pre> 
function my_dump( $x, $label = '' )
{
    echo "<pre>";
    if( $label != '' ) echo $label."\n";
    var_dump( $x );
    echo "</pre>";
}