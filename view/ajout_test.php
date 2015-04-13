<?php
    // create a new form
    $form = new Zebra_Form('my_form');
     
    // add a date control to the form
    $mydate = $form->add('date', 'my_date');
    $mydate->set_rule(array(
        'required'      =>  array('error', 'Date is required!'),
        'date'          =>  array('error', 'Date is invalid!'),
    ));
    
    // set the date's format
    $mydate->format('M d, Y');
     
    // don't forget to always call this method before rendering the form
    if ($form->validate()) {
     
        // get the date in YYYY-MM-DD format so you can play with is easily
        $date = $mydate->get_date();
     
    }
     
    // output the form using an automatically generated template
    $form->render();
?>