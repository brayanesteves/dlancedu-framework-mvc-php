<?php
    class Registry {
        private static $_instancia = null;
        private $_data;

        /**
         * [ENGLISH]
         * ================
         * [SPANISH]
         * No se puede instanciar la clase.
         */
        private function __construct() {}

        /**
         * [ENGLISH]
         * Singleton pattern.
         * ================
         * [SPANISH]
         * Patrón único.
         */
        public static function getInstancia() {
            if (!self::$_instancia instanceof self) {
                self::$_instancia = new Registry();
            }
            return self::$_instancia;
        }

        public function __set($name, $value) {
            $this->_data[$name] = $value;
        }

        public function __get($name) {
            if(isset($this->_data[$name])) {
                return $this->_data[$name];
            }
            return false;
        }
    }
    
?>