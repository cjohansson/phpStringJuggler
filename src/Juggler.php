<?php

namespace StringJuggler;

/**
 * String juggler class.
 *
 * @author Christian Johansson <christian@cvj.se>
 * @author Cami Mostajo
 * @license MIT
 * @version 1.0.1
 */
class Juggler
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
     * @return self
     */
    public function getAfter($search)
    {
        if ($start = $this->getAfterPosition($search)) {
            return new self(
                substr($this->_string, $start));
        }
        return new self();
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
     * @return self
     */
    public function getBefore($search)
    {
        if ($start = $this->getBeforePosition($search)) {
            return new self(
                substr($this->_string, 0, $start));
        }
        return new self();
    }

    /**
     * @param string $delimiter
     * @param int|null [$limit = null]
     * @return self|array
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
            && count($explodes) > 0
        ) {
            $return = array();
            foreach ($explodes as $explode)
            {
                $return[] = new self($explode);
            }
            if (count($return) > 0) {
                return $return;
            }
        }
        return new self();
    }

    /**
     * @param string $search
     * @param string $replace
     * @param int|null $count
     * @return bool
     */
    public function replace($search, $replace, &$count = null)
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
    public function ireplace($search, $replace, &$count = null)
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
     * @return self
     */
    public function getReplace($search, $replace, &$count = null)
    {
        return new self(
            str_replace($search, $replace, $this->_string, $count));
    }

    /**
     * @param string $pattern
     * @param string $replacement
     * @param int|null [$limit = -1]
     * @param int|null [$count = null]
     * @return bool
     */
    public function pregReplace($pattern, $replacement, $limit = -1, &$count = null)
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
     * @return self
     */
    public function getPregReplace($pattern, $replacement, $limit = -1, &$count = null)
    {
        return new self(
            preg_replace($pattern, $replacement, $this->_string, $limit, $count));
    }

    /**
     * @param string $pattern
     * @param array [$matches = array()]
     * @param int [$flags = 0]
     * @param int [$offset = 0]
     * @return bool
     */
    public function pregMatch($pattern, &$matches = array(), $flags = 0, $offset = 0)
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
     * @return array|self
     */
    public function getPregMatches($pattern, $flags = 0, $offset = 0)
    {
        $matches = array();
        if ($this->pregMatch($pattern, $matches, $flags, $offset)) {
            $newMatches = array();
            foreach ($matches as $match) {
                $newMatches[] = new self($match);
            }
            return $newMatches;
        }
        return new self();
    }

    /**
     * @param string $search
     * @param string $replace
     * @param int|null $count
     * @return self
     */
    public function getIReplace($search, $replace, &$count = null)
    {
        return new self(
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
     * @return self
     */
    public function getTrimmed()
    {
        if ($newString = trim($this->_string)) {
            return new self($newString);
        }
        return new self();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getString();
    }

}