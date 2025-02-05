<?php

class nacexcontrolversion
{
    
    public Function existeversion(){
        
        if (Configuration::get('NACEX_VERSION') == null) {

            return true;
        }
        
        
    }
    
    
}