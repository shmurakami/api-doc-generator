<?php
namespace shmurakami\SwaggerGenerator\Formatters;

use Symfony\Component\Yaml\Yaml;

class YamlFormatter implements FormatterInterface
{

    public function generate($values)
    {
        // depend to symfony\yaml
        $depth = $this->getDepth($values);
        return Yaml::dump($values, $depth, 2, true);
    }

    /**
     * @param $array
     * @return float
     * @see http://stackoverflow.com/questions/262891/is-there-a-way-to-find-out-how-deep-a-php-array-is
     */
    private function getDepth($array)
    {
        $maxIndentation = 1;

        $arrayString = print_r($array, true);
        $lines = explode("\n", $arrayString);

        foreach ($lines as $line) {
            $indentation = (strlen($line) - strlen(ltrim($line))) / 4;

            if ($indentation > $maxIndentation) {
                $maxIndentation = $indentation;
            }
        }

        return ceil(($maxIndentation - 1) / 2) + 1;

    }
}
