<?php

$event_conference_term_event_cat = get_the_terms( get_the_ID(), 'event_cat' );

var_dump($event_conference_term_event_cat);