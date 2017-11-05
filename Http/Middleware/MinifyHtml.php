<?php namespace Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class MinifyHtml
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Compress output
        ini_set("pcre.recursion_limit", "16777");
        $buffer = $response->getContent();
        $re = '%# Collapse whitespace everywhere but in blacklisted elements.
		(?>             # Match all whitespans other than single space.
		  [^\S ]\s*     # Either one [\t\r\n\f\v] and zero or more ws,
		| \s{2,}        # or two or more consecutive-any-whitespace.
		) # Note: The remaining regex consumes no text at all...
		(?=             # Ensure we are not in a blacklist tag.
		  [^<]*+        # Either zero or more non-"<" {normal*}
		  (?:           # Begin {(special normal*)*} construct
			<           # or a < starting a non-blacklist tag.
			(?!/?(?:textarea|pre|script)\b)
			[^<]*+      # more non-"<" {normal*}
		  )*+           # Finish "unrolling-the-loop"
		  (?:           # Begin alternation group.
			<           # Either a blacklist start tag.
			(?>textarea|pre|script)\b
		  | \z          # or end of file.
		  )             # End alternation group.
		)  # If we made it here, we are not in a blacklist tag.
		%Six';

        $new_buffer = preg_replace($re, " ", $buffer);

        // We are going to check if processing has working
        if ($new_buffer === null) {
            $new_buffer = $buffer;
        }

        $response->setContent($new_buffer);

        return $response;
    }
}