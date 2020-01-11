<?php

namespace Rocky114\Excel\Reader\CSV\Manager;

use Rocky114\Excel\Common\Helper\EncodingHelper;
use Rocky114\Excel\Common\Manager\OptionsManagerAbstract;
use Rocky114\Excel\Reader\Common\Entity\Options;

/**
 * Class OptionsManager
 * CSV Reader options manager
 */
class OptionsManager extends OptionsManagerAbstract
{
    /**
     * {@inheritdoc}
     */
    protected function getSupportedOptions()
    {
        return [
            Options::SHOULD_FORMAT_DATES,
            Options::SHOULD_PRESERVE_EMPTY_ROWS,
            Options::FIELD_DELIMITER,
            Options::FIELD_ENCLOSURE,
            Options::ENCODING,
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function setDefaultOptions()
    {
        $this->setOption(Options::SHOULD_FORMAT_DATES, false);
        $this->setOption(Options::SHOULD_PRESERVE_EMPTY_ROWS, false);
        $this->setOption(Options::FIELD_DELIMITER, ',');
        $this->setOption(Options::FIELD_ENCLOSURE, '"');
        $this->setOption(Options::ENCODING, EncodingHelper::ENCODING_UTF8);
    }
}
