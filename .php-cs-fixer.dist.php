<?php
$finder = PhpCsFixer\Finder::create()
    ->notPath('bootstrap')
    ->notPath('node_modules')
    ->notPath('public')
    ->notPath('storage')
    ->notPath('vendor')
    ->notPath('_ide_helper.php')
    ->notPath('.phpstorm.meta.php')
    ->in(__DIR__)
    ->name('*.php')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$config = new PhpCsFixer\Config();
return $config->setRiskyAllowed(true)
    ->setRules([
        '@PSR2' => true,
        '@Symfony' => true,
        'binary_operator_spaces' => [
          'operators' => [
            '=' => 'align_single_space_minimal',
            '=>' => 'align_single_space_minimal',
            '??' => 'align_single_space_minimal',
          ],
        ],
        'array_syntax' => ['syntax' => 'short'],
        'concat_space' => ['spacing' => 'one'],
        'linebreak_after_opening_tag' => true,
        'is_null' => true,
        'ordered_imports' => true,
        'phpdoc_order' => true,
        'phpdoc_summary' => false,
        'phpdoc_separation' => false,
        'phpdoc_align' => [
          'tags' => ['param', 'property', 'throws', 'type', 'var'],
        ],
        'yoda_style' => [
          'equal' => false,
          'identical' => false,
        ],
    ])
    ->setFinder($finder);
