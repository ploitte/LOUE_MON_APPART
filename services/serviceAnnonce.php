<?php

    Class serviceAnnonce{

        private $error;
        private $params;

    /*** GETTERS ET SETTERS **/

        /**
        * @return mixed
        */
        public function getParams()
        {
            return $this->params;
        }

        /**
        * @param mixed $params
        */
        public function setParams($params)
        {
            $this->params = $params;
        }

        /**
        * @return mixed
        */
        public function getError()
        {
            return $this->error;
        }

        /**
        * @param mixed $error
        */
        public function setError($error)
        {
            $this->error = $error;
        }


        public function launchControls(){
        
            if(empty($this-> params['surface'])){
                $this-> error['emptySurface'] = 'a';
            }

            // if(empty($this-> params['nb_chambre'])){
            //     $this-> error['emptySurface'] = 'a';
            // }

            // if(empty($this-> params['prix'])){
            //     $this-> error['emptySurface'] = 'a';
            // }

            // if(empty($this-> params['titre'])){
            //     $this-> error['emptySurface'] = 'a';
            // }

            // if(empty($this-> params['desc'])){
            //     $this-> error['emptyDesc'] = 'a';
            // }

            if(!empty($this -> error)){
                return $this -> error;
            }else{
                return true;
            }
        }


    }

?>