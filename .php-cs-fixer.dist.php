<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()->in([
    __DIR__.'/src',
    __DIR__.'/tests',
]);

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR1' => true,
        '@PSR2' => true,
        '@PSR12' => true,
        '@PSR12:risky' => true,
        '@Symfony' => true,
        '@Symfony:risky' => true,
        'array_indentation' => true,
        'echo_tag_syntax' => ['format' => 'short'],
        'explicit_indirect_variable' => true,
        'control_structure_continuation_position' => true,
        'declare_strict_types' => true,
        'declare_parentheses' => true,
        'global_namespace_import' => [
            'import_classes' => true,
            'import_constants' => true,
            'import_functions' => false,
        ],
        'linebreak_after_opening_tag' => true,
        'mb_str_functions' => true,
        'method_chaining_indentation' => true,
        'multiline_whitespace_before_semicolons' => true,
        'no_unreachable_default_argument_value' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'php_unit_method_casing' => ['case' => 'snake_case'],
        'php_unit_strict' => true,
        'phpdoc_order' => true,
        'regular_callable_call' => true,
        'simplified_if_return' => true,
        'simplified_null_return' => true,
        'strict_comparison' => true,
        'strict_param' => true,
        'yoda_style' => ['equal' => false, 'identical' => false],
        'phpdoc_to_comment' => false,
    ])
    ->setFinder($finder);
