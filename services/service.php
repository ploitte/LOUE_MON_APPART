<?php
    abstract class service{

        protected $error;
        protected $params;

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
        public function getImage()
        {
            return $this->image;
        }

        /**
        * @param mixed $params
        */
        public function setImage($image)
        {
            $this->image = $image;
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

        protected function saveError($arg1, $arg2){
            $this -> error[$arg1] = $arg2;
        }
        

}