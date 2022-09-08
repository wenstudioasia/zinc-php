<?php

namespace Vanderw\ZincPhp\Option;

class SearchType
{
    const MATCH_ALL = 'matchall'; // Return all documents of the index.
    const MATCH = 'match'; // like a term query, but the input text is analyzed first
    const MATCH_PHRASE = 'matchphrase';
    const TERM = 'term'; // searches for an exact term.
    const QUERY_STRING = 'query_string'; // allows humans to describe complex queries using a simple syntax.
    const PREFIX = 'prefix'; // finds documents containing terms that start with the provided prefix
    const WILDCARD = 'wildcard'; // finds documents containing term that start with the provided wildcard
    const FUZZY = 'fuzzy'; // A term query that matches terms within a specified edit distance
    const DATE_RANGE = 'daterange'; //finds documents containing a date value in the specified field within the specified range
}
