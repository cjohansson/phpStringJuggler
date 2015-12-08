<?php
/**
 *
 */

/**
 * 
 */
namespace StringJuggler
{

    /**
     * 
     */
    class String
    {
    
        /**
         * @var string
         */
        private $_string = '';
    
        /**
         * @param string|null $string
         */
        public function __construct($string = null)
        {
            if (isset($string)) {
                $this->setString($string);
            }
        }
    
        /**
         * @param string $string
         */
        public function setString($string)
        {
            $this->_string = $string;
        }
    
        /**
         * @return string
         */
        public function getString()
        {
            return $this->_string;
        }
    
        /**
         * @param string $search
         * @return bool
         */
        public function after($search)
        {
            if ($start = $this->getAfterPosition($search)) {
                $this->_string =
                    substr($this->_string, $start);
                return true;
            }
            return false;
        }
    
        /**
         * @param string $search
         * @return \StringJuggler\String
         */
        public function getAfter($search)
        {
            if ($start = $this->getAfterPosition($search)) {
                return new \StringJuggler\String(
                    substr($this->_string, $start));
            }
            return new \StringJuggler\String();
        }
    
    
        /**
         * @param string $search
         * @return int|bool
         */
        public function getAfterPosition($search)
        {
            $start = stripos($this->_string, $search, 0);
            if ($start !== false) {
                $start += strlen($search);
                return $start;
            }
            return false;
        }

        /**
         * @return bool
         */
        public function isNotEmpty()
        {
            return !$this->isEmpty();
        }

        /**
         * @return bool
         */
        public function isEmpty()
        {
            return empty($this->_string);
        }
    
        /**
         * @param string $search
         * @return \StringJuggler\String
         */
        public function getBefore($search)
        {
            if ($start = $this->getBeforePosition($search)) {
                return new \StringJuggler\String(
                    substr($this->_string, 0, $start));
            }
            return new \StringJuggler\String();
        }
    
        /**
         * @param string $delimiter
         * @param int|null [$limit = null]
         * @return bool|array
         */
        public function getExplode($delimiter, $limit = null)
        {
            if (isset($limit)) {
                $explodes = explode($delimiter, $this->_string, $limit);
            } else {
                $explodes = explode($delimiter, $this->_string);
            }
            if (isset($explodes)
                && is_array($explodes)
                && sizeof($explodes) > 0
            ) {
                $return = array();
                foreach ($explodes as $explode)
                {
                    $return[] = new \StringJuggler\String(
                        $explode);
                }
                if (sizeof($return) > 0) {
                    return $return;
                }
            }
            return new \StringJuggler\String();
        }
    
        /**
         * @param string $search
         * @param string $replace
         * @param int|null $count
         * @return bool
         */
        public function replace($search, $replace,
                        & $count = null)
        {
            if ($this->_string =
                str_replace($search, $replace, $this->_string, $count)
            ) {
                return true;
            }
            return false;
        }
    
        /**
         * @param string $search
         * @param string $replace
         * @param int|null $count
         * @return bool
         */
        public function ireplace($search, $replace,
                                 & $count = null)
        {
            if ($this->_string =
                str_ireplace($search, $replace, $this->_string, $count)
            ) {
                return true;
            }
            return false;
        }
    
        /**
         * @param string $search
         * @param string $replace
         * @param int|null $count
         * @return \StringJuggler\String
         */
        public function getReplace($search, $replace,
                                   & $count = null)
        {
            return new \StringJuggler\String(
                str_replace($search, $replace, $this->_string, $count));
        }
    
        /**
         * @param string $pattern
         * @param string $replacement
         * @param int|null [$limit = -1]
         * @param int|null [$count = null]
         * @return bool
         */
        public function pregReplace($pattern, $replacement,
                                    $limit = -1, & $count = null)
        {
            $this->_string =
                preg_replace($pattern, $replacement, $this->_string, $limit, $count);
            return true;
        }
    
        /**
         * @param string $pattern
         * @param string $replacement
         * @param int|null [$limit = -1]
         * @param int|null [$count = null]
         * @return bool
         */
        public function getPregReplace($pattern, $replacement,
                                       $limit = -1, & $count = null)
        {
            return
                preg_replace($pattern, $replacement, $this->_string, $limit, $count);
        }
    
        /**
         * @param string $pattern
         * @param array [$matches = array()]
         * @param int [$flags = 0]
         * @param int [$offset = 0]
         * @return bool
         */
        public function pregMatch($pattern,
                                  & $matches = array(), $flags = 0, $offset = 0)
        {
            if (preg_match($pattern, $this->_string,
                    $matches, $flags, $offset) == 1
            ) {
                return true;
            }
            return false;
        }
    
        /**
         * @param string $pattern
         * @param int [$flags = 0]
         * @param int [$offset = 0]
         * @return array|bool
         */
        public function getPregMatches($pattern, $flags = 0, $offset = 0)
        {
            $matches = array();
            if ($this->pregMatch($pattern, $matches, $flags, $offset)) {
                return $matches;
            }
            return new \StringJuggler\String();
        }
    
        /**
         * @param string $search
         * @param string $replace
         * @param int|null $count
         * @return \StringJuggler\String
         */
        public function getIReplace($search, $replace,
                                    & $count = null)
        {
            return new \StringJuggler\String(
                str_ireplace($search, $replace, $this->_string, $count));
        }
    
        /**
         * @param string $search
         * @return bool
         */
        public function before($search)
        {
            if ($start = $this->getBeforePosition($search)) {
                $this->_string =
                    substr($this->_string, 0, $start);
                return true;
            }
            return false;
        }
    
        /**
         * @param string $search
         * @return int|bool
         */
        public function getBeforePosition($search)
        {
            $start = stripos($this->_string, $search, 0);
            if ($start !== false) {
                return $start;
            }
            return false;
        }
    
        /**
         * @return bool
         */
        public function trim()
        {
            trim($this->_string);
            return true;
        }

        /**
         * @return \StringJuggler\String
         */
        public function getTrimmed()
        {
            if ($newString = trim($this->_string)) {
                return new \StringJuggler\String($newString);
            }
            return new \StringJuggler\String();
        }
    
        /**
         * @return string
         */
        public function __toString()
        {
            return $this->getString();
        }
    
    }
    
}
