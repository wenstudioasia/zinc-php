<?php

namespace Vanderw\ZincPhp\Option\Analyze;

class TokenFilter
{
    const APOSTROPHE = 'apostrophe';
    const CAMEL_CASE = 'camel_case';
    const LOWER_CASE = 'lower_case';
    const UPPER_CASE = 'upper_case';
    const DICT = 'dict';
    const NGRAM = 'ngram';
    const EDGE_NGRAM = 'edge_ngram';
    const ELISION = 'elision';
    const KEYWORD = 'keyword';
    const LENGTH = 'length';
    const PORTER = 'porter';
    const REVERSE = 'reverse';
    const REGEXP = 'regexp';
    const SINGLE = 'single';
    const TRIM = 'trim';
    const STOP = 'stop';
    const TRUNCATE = 'truncate';
    const UNICODENORM = 'unicodenorm';
    const UNIQUE = 'unique';
    const GSE_STOP = 'gse_stop';

    // languages tokenfilters
    const ARABIC_NORMALIZATION = 'arabic_normalization';
    const ARABIC_STEMMER = 'arabic_stemmer';
    const CJK_BIGRAM = 'cjk_bigram';
    const CJK_WIDTH = 'cjk_width';
    const SORANI_NORMALIZATION = 'sorani_normalization';
    const SORANI_STEMMER = 'sorani_stemmer';
    const DANISH_STEMMER = 'danish_stemmer';
    const GERMAN_NORMALIZATION = 'german_normalization';
    const GERMAN_STEMMER = 'german_stemmer';
    const GERMAN_LIGHT_STEMMER = 'german_light_stemmer';
    const ENGLISH_POSSESSIVE_STEMMER = 'english_possessive_stemmer';
    const ENGLISH_STEMMER = 'english_stemmer';
    const SPANISH_STEMMER = 'spanish_stemmer';
    const SPANISH_LIGHT_STEMMER = 'spanish_light_stemmer';
    const PERSION_NORMALIZATION = 'persion_normalization';
    const FINNISH_STEMMER = 'finnish_stemmer';
    const FRENCH_ELISION = 'french_elision';
    const FRENCH_STEMMER = 'french_stemmer';
    const FRENCH_LIGHT_STEMMER = 'french_light_stemmer';
    const FRENCH_MINIMAL_STEMMER = 'french_minimal_stemmer';
    const IRISH_ELISION = 'irish_elision';
    const HUNGARIAN_STEMMER = 'hungarian_stemmer';
    const INDIC_NORMALIZATION = 'indic_normalization';
    const ITALIAN_ELISION = 'italian_elision';
    const ITALIAN_STEMMER = 'italian_stemmer';
    const ITALIAN_LIGHT_STEMMER = 'italian_light_stemmer';
    const DUTCH_STEMMER = 'dutch_stemmer';
    const NORWEGIAN_STEMMER = 'norwegian_stemmer';
    const PORTUGUESE_STEMMER = 'portuguese_stemmer';
    const PORTUGUESE_LIGHT_STEMMER = 'portuguese_light_stemmer';
    const ROMANIAN_STEMMER = 'romanian_stemmer';
    const RUSSIAN_STEMMER = 'russian_stemmer';
    const SWEDISH_STEMMER = 'swedish_stemmer';
    const TURKISH_STEMMER = 'turkish_stemmer';
}
