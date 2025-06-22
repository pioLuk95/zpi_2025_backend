<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>WSGmed API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../docs/css/theme-default.style.css" media="screen">
    <link rel="stylesheet" href="../docs/css/theme-default.print.css" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="../docs/js/tryitout-5.2.1.js"></script>

    <script src="../docs/js/theme-default-5.2.1.js"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="../docs/images/navbar.png" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-GETapi-documentation">
                                <a href="#endpoints-GETapi-documentation">Handles the API request and renders the Swagger documentation view.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETdocs-asset--asset-">
                                <a href="#endpoints-GETdocs-asset--asset-">Serves a specific documentation asset for the Swagger UI interface.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-oauth2-callback">
                                <a href="#endpoints-GETapi-oauth2-callback">Handles the OAuth2 callback and retrieves the required file for the redirect.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETup">
                                <a href="#endpoints-GETup">GET up</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GET-">
                                <a href="#endpoints-GET-">GET /</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETlogin">
                                <a href="#endpoints-GETlogin">Show the application's login form.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTlogin">
                                <a href="#endpoints-POSTlogin">Handle a login request to the application.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTlogout">
                                <a href="#endpoints-POSTlogout">Log the user out of the application.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETregister">
                                <a href="#endpoints-GETregister">Show the application registration form.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTregister">
                                <a href="#endpoints-POSTregister">Handle a registration request for the application.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETpassword-reset">
                                <a href="#endpoints-GETpassword-reset">Display the form to request a password reset link.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTpassword-email">
                                <a href="#endpoints-POSTpassword-email">Send a reset link to the given user.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETpassword-reset--token-">
                                <a href="#endpoints-GETpassword-reset--token-">Display the password reset view for the given token.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTpassword-reset">
                                <a href="#endpoints-POSTpassword-reset">Reset the given user's password.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETpassword-confirm">
                                <a href="#endpoints-GETpassword-confirm">Display the password confirmation view.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTpassword-confirm">
                                <a href="#endpoints-POSTpassword-confirm">Confirm the given user's password.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GEThome">
                                <a href="#endpoints-GEThome">Show the application dashboard.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETpatients">
                                <a href="#endpoints-GETpatients">Display a listing of the resource.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETpatients-create">
                                <a href="#endpoints-GETpatients-create">Show the form for creating a new resource.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTpatients">
                                <a href="#endpoints-POSTpatients">Store a newly created resource in storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETpatients--id-">
                                <a href="#endpoints-GETpatients--id-">Display the specified resource.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETpatients--patient_id--edit">
                                <a href="#endpoints-GETpatients--patient_id--edit">Show the form for editing the specified resource.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTpatients--id-">
                                <a href="#endpoints-PUTpatients--id-">Update the specified resource in storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEpatients--id-">
                                <a href="#endpoints-DELETEpatients--id-">Remove the specified resource from storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETmedications">
                                <a href="#endpoints-GETmedications">Display a listing of the resource.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETmedications-create">
                                <a href="#endpoints-GETmedications-create">Show the form for creating a new resource.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTmedications">
                                <a href="#endpoints-POSTmedications">Store a newly created resource in storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETmedications--id-">
                                <a href="#endpoints-GETmedications--id-">Display the specified resource.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETmedications--medication_id--edit">
                                <a href="#endpoints-GETmedications--medication_id--edit">Show the form for editing the specified resource.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTmedications--id-">
                                <a href="#endpoints-PUTmedications--id-">Update the specified resource in storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEmedications--id-">
                                <a href="#endpoints-DELETEmedications--id-">Remove the specified resource from storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETlocations">
                                <a href="#endpoints-GETlocations">Display a listing of the resource.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETlocations-create">
                                <a href="#endpoints-GETlocations-create">Show the form for creating a new resource.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTlocations">
                                <a href="#endpoints-POSTlocations">Store a newly created resource in storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETlocations--id-">
                                <a href="#endpoints-GETlocations--id-">Display the specified resource.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETlocations--location_id--edit">
                                <a href="#endpoints-GETlocations--location_id--edit">Show the form for editing the specified resource.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTlocations--id-">
                                <a href="#endpoints-PUTlocations--id-">Update the specified resource in storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETElocations--id-">
                                <a href="#endpoints-DELETElocations--id-">Remove the specified resource from storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETpatients--patient_id--medical_records-create">
                                <a href="#endpoints-GETpatients--patient_id--medical_records-create">Show the form for creating a new resource.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTmedical-records">
                                <a href="#endpoints-POSTmedical-records">Store a newly created resource in storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEmedical_records--medicalRecord_id-">
                                <a href="#endpoints-DELETEmedical_records--medicalRecord_id-">Remove the specified resource from storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETstorage--path-">
                                <a href="#endpoints-GETstorage--path-">GET storage/{path}</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="../docs/collection.json">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="../docs/openapi.yaml">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: May 13, 2025</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>http://localhost</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-GETapi-documentation">Handles the API request and renders the Swagger documentation view.</h2>

<p>
</p>



<span id="example-requests-GETapi-documentation">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/documentation" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/documentation"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-documentation">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-documentation" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-documentation"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-documentation"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-documentation" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-documentation">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-documentation" data-method="GET"
      data-path="api/documentation"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-documentation', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-documentation"
                    onclick="tryItOut('GETapi-documentation');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-documentation"
                    onclick="cancelTryOut('GETapi-documentation');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-documentation"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/documentation</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-documentation"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-documentation"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETdocs-asset--asset-">Serves a specific documentation asset for the Swagger UI interface.</h2>

<p>
</p>



<span id="example-requests-GETdocs-asset--asset-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/docs/asset/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/docs/asset/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETdocs-asset--asset-">
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;(consequatur) - this L5 Swagger asset is not allowed&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETdocs-asset--asset-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETdocs-asset--asset-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETdocs-asset--asset-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETdocs-asset--asset-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETdocs-asset--asset-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETdocs-asset--asset-" data-method="GET"
      data-path="docs/asset/{asset}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETdocs-asset--asset-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETdocs-asset--asset-"
                    onclick="tryItOut('GETdocs-asset--asset-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETdocs-asset--asset-"
                    onclick="cancelTryOut('GETdocs-asset--asset-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETdocs-asset--asset-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>docs/asset/{asset}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETdocs-asset--asset-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETdocs-asset--asset-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>asset</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="asset"                data-endpoint="GETdocs-asset--asset-"
               value="consequatur"
               data-component="url">
    <br>
<p>The asset. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-oauth2-callback">Handles the OAuth2 callback and retrieves the required file for the redirect.</h2>

<p>
</p>



<span id="example-requests-GETapi-oauth2-callback">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/oauth2-callback" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/oauth2-callback"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-oauth2-callback">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">content-type: text/html; charset=UTF-8
cache-control: no-cache, private
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">&lt;!doctype html&gt;
&lt;html lang=&quot;en-US&quot;&gt;
&lt;head&gt;
    &lt;title&gt;Swagger UI: OAuth2 Redirect&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
&lt;script&gt;
    &#039;use strict&#039;;
    function run () {
        var oauth2 = window.opener.swaggerUIRedirectOauth2;
        var sentState = oauth2.state;
        var redirectUrl = oauth2.redirectUrl;
        var isValid, qp, arr;

        if (/code|token|error/.test(window.location.hash)) {
            qp = window.location.hash.substring(1).replace(&#039;?&#039;, &#039;&amp;&#039;);
        } else {
            qp = location.search.substring(1);
        }

        arr = qp.split(&quot;&amp;&quot;);
        arr.forEach(function (v,i,_arr) { _arr[i] = &#039;&quot;&#039; + v.replace(&#039;=&#039;, &#039;&quot;:&quot;&#039;) + &#039;&quot;&#039;;});
        qp = qp ? JSON.parse(&#039;{&#039; + arr.join() + &#039;}&#039;,
                function (key, value) {
                    return key === &quot;&quot; ? value : decodeURIComponent(value);
                }
        ) : {};

        isValid = qp.state === sentState;

        if ((
          oauth2.auth.schema.get(&quot;flow&quot;) === &quot;accessCode&quot; ||
          oauth2.auth.schema.get(&quot;flow&quot;) === &quot;authorizationCode&quot; ||
          oauth2.auth.schema.get(&quot;flow&quot;) === &quot;authorization_code&quot;
        ) &amp;&amp; !oauth2.auth.code) {
            if (!isValid) {
                oauth2.errCb({
                    authId: oauth2.auth.name,
                    source: &quot;auth&quot;,
                    level: &quot;warning&quot;,
                    message: &quot;Authorization may be unsafe, passed state was changed in server. The passed state wasn&#039;t returned from auth server.&quot;
                });
            }

            if (qp.code) {
                delete oauth2.state;
                oauth2.auth.code = qp.code;
                oauth2.callback({auth: oauth2.auth, redirectUrl: redirectUrl});
            } else {
                let oauthErrorMsg;
                if (qp.error) {
                    oauthErrorMsg = &quot;[&quot;+qp.error+&quot;]: &quot; +
                        (qp.error_description ? qp.error_description+ &quot;. &quot; : &quot;no accessCode received from the server. &quot;) +
                        (qp.error_uri ? &quot;More info: &quot;+qp.error_uri : &quot;&quot;);
                }

                oauth2.errCb({
                    authId: oauth2.auth.name,
                    source: &quot;auth&quot;,
                    level: &quot;error&quot;,
                    message: oauthErrorMsg || &quot;[Authorization failed]: no accessCode received from the server.&quot;
                });
            }
        } else {
            oauth2.callback({auth: oauth2.auth, token: qp, isValid: isValid, redirectUrl: redirectUrl});
        }
        window.close();
    }

    if (document.readyState !== &#039;loading&#039;) {
        run();
    } else {
        document.addEventListener(&#039;DOMContentLoaded&#039;, function () {
            run();
        });
    }
&lt;/script&gt;
&lt;/body&gt;
&lt;/html&gt;
</code>
 </pre>
    </span>
<span id="execution-results-GETapi-oauth2-callback" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-oauth2-callback"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-oauth2-callback"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-oauth2-callback" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-oauth2-callback">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-oauth2-callback" data-method="GET"
      data-path="api/oauth2-callback"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-oauth2-callback', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-oauth2-callback"
                    onclick="tryItOut('GETapi-oauth2-callback');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-oauth2-callback"
                    onclick="cancelTryOut('GETapi-oauth2-callback');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-oauth2-callback"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/oauth2-callback</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-oauth2-callback"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-oauth2-callback"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETup">GET up</h2>

<p>
</p>



<span id="example-requests-GETup">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/up" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/up"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETup">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">&lt;!DOCTYPE html&gt;
&lt;html lang=&quot;en&quot;&gt;
&lt;head&gt;
    &lt;meta charset=&quot;utf-8&quot;&gt;
    &lt;meta name=&quot;viewport&quot; content=&quot;width=device-width, initial-scale=1&quot;&gt;

    &lt;title&gt;WSGmed&lt;/title&gt;

    &lt;!-- Fonts --&gt;
    &lt;link rel=&quot;preconnect&quot; href=&quot;https://fonts.bunny.net&quot;&gt;
    &lt;link href=&quot;https://fonts.bunny.net/css?family=figtree:400,600&amp;display=swap&quot; rel=&quot;stylesheet&quot; /&gt;

    &lt;!-- Styles --&gt;
    &lt;script src=&quot;https://cdn.tailwindcss.com&quot;&gt;&lt;/script&gt;

    &lt;script&gt;
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: [&#039;Figtree&#039;, &#039;ui-sans-serif&#039;, &#039;system-ui&#039;, &#039;sans-serif&#039;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;],
                    }
                }
            }
        }
    &lt;/script&gt;
&lt;/head&gt;
&lt;body class=&quot;antialiased&quot;&gt;
&lt;div class=&quot;relative flex justify-center items-center min-h-screen bg-gray-100 selection:bg-red-500 selection:text-white&quot;&gt;
    &lt;div class=&quot;w-full sm:w-3/4 xl:w-1/2 mx-auto p-6&quot;&gt;
        &lt;div class=&quot;px-6 py-4 bg-white from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex items-center focus:outline focus:outline-2 focus:outline-red-500&quot;&gt;
            &lt;div class=&quot;relative flex h-3 w-3 group &quot;&gt;
                &lt;span class=&quot;animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 group-[.status-down]:bg-red-600 opacity-75&quot;&gt;&lt;/span&gt;
                &lt;span class=&quot;relative inline-flex rounded-full h-3 w-3 bg-green-400 group-[.status-down]:bg-red-600&quot;&gt;&lt;/span&gt;
            &lt;/div&gt;

            &lt;div class=&quot;ml-6&quot;&gt;
                &lt;h2 class=&quot;text-xl font-semibold text-gray-900&quot;&gt;Application up&lt;/h2&gt;

                &lt;p class=&quot;mt-2 text-gray-500 dark:text-gray-400 text-sm leading-relaxed&quot;&gt;
                    HTTP request received.

                                            Response rendered in 537ms.
                                    &lt;/p&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;
&lt;/body&gt;
&lt;/html&gt;
</code>
 </pre>
    </span>
<span id="execution-results-GETup" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETup"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETup"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETup" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETup">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETup" data-method="GET"
      data-path="up"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETup', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETup"
                    onclick="tryItOut('GETup');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETup"
                    onclick="cancelTryOut('GETup');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETup"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>up</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETup"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETup"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GET-">GET /</h2>

<p>
</p>



<span id="example-requests-GET-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GET-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">content-type: text/html; charset=UTF-8
cache-control: no-cache, private
set-cookie: XSRF-TOKEN=eyJpdiI6IjIwcXgzWTJMblZUamxldFlDWnhBVWc9PSIsInZhbHVlIjoiYUpHa0s0ZFB2UlREQmplTXljS2tWWko1L0hUbFpKNGtSMEg3SGt5ay94T0pDRlNPUEJKYVRtMFU4YkpqNUlGcTNIU0dvMVltYmhxZkM2QjRDZWpEanIxSnlTWHVrYkM3QVNPVmpvNlF5U2xLSGhacHVuYkdVZElYcEpMUGlhMDEiLCJtYWMiOiIyNWI2MWViNTk2YTBlZmJhNDhlYWEzOGJjZjdiOTUwMzZmOTg1YTA5NDBlMTJkOTg0YTFiYjBkNDYxNjUwZDk0IiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; samesite=lax; wsgmed_session=eyJpdiI6Ijd0SnVBbmRxRjJOZ0hYcFMwL2MvTmc9PSIsInZhbHVlIjoiQ0RTNlFlakVJTElROU5OY2JlbmF1d1ZKSDVoenlFNFFRZmp2T2NvVmFYWldmVk9vcnNnaWFEQ2RHdFRJK3FmMWhiL1l2TEhSMU9GYnBibzJKQTdkeFliWUp0bWx2KzRnclBEZEVPNWZuZFAyY21aTHVQTDJ6OFNZSmdSd1F1c2siLCJtYWMiOiI0NDU3MTdlM2ViZjdiNjI1MzA1NWVlMjI2MzZhOTdlODM2NzU2Y2EzYmRjYTgxZjhmNjA5YWZiMTBlOTUxZmNjIiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">&lt;!DOCTYPE html&gt;
&lt;html lang=&quot;en&quot;&gt;
    &lt;head&gt;
        &lt;meta charset=&quot;utf-8&quot;&gt;
        &lt;meta name=&quot;viewport&quot; content=&quot;width=device-width, initial-scale=1&quot;&gt;

        &lt;title&gt;Laravel&lt;/title&gt;

        &lt;!-- Fonts --&gt;
        &lt;link rel=&quot;preconnect&quot; href=&quot;https://fonts.bunny.net&quot;&gt;
        &lt;link href=&quot;https://fonts.bunny.net/css?family=instrument-sans:400,500,600&quot; rel=&quot;stylesheet&quot; /&gt;

        &lt;!-- Styles / Scripts --&gt;
                    &lt;style&gt;
                /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */@layer theme{:root,:host{--font-sans:&#039;Instrument Sans&#039;,ui-sans-serif,system-ui,sans-serif,&quot;Apple Color Emoji&quot;,&quot;Segoe UI Emoji&quot;,&quot;Segoe UI Symbol&quot;,&quot;Noto Color Emoji&quot;;--font-serif:ui-serif,Georgia,Cambria,&quot;Times New Roman&quot;,Times,serif;--font-mono:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,&quot;Liberation Mono&quot;,&quot;Courier New&quot;,monospace;--color-red-50:oklch(.971 .013 17.38);--color-red-100:oklch(.936 .032 17.717);--color-red-200:oklch(.885 .062 18.334);--color-red-300:oklch(.808 .114 19.571);--color-red-400:oklch(.704 .191 22.216);--color-red-500:oklch(.637 .237 25.331);--color-red-600:oklch(.577 .245 27.325);--color-red-700:oklch(.505 .213 27.518);--color-red-800:oklch(.444 .177 26.899);--color-red-900:oklch(.396 .141 25.723);--color-red-950:oklch(.258 .092 26.042);--color-orange-50:oklch(.98 .016 73.684);--color-orange-100:oklch(.954 .038 75.164);--color-orange-200:oklch(.901 .076 70.697);--color-orange-300:oklch(.837 .128 66.29);--color-orange-400:oklch(.75 .183 55.934);--color-orange-500:oklch(.705 .213 47.604);--color-orange-600:oklch(.646 .222 41.116);--color-orange-700:oklch(.553 .195 38.402);--color-orange-800:oklch(.47 .157 37.304);--color-orange-900:oklch(.408 .123 38.172);--color-orange-950:oklch(.266 .079 36.259);--color-amber-50:oklch(.987 .022 95.277);--color-amber-100:oklch(.962 .059 95.617);--color-amber-200:oklch(.924 .12 95.746);--color-amber-300:oklch(.879 .169 91.605);--color-amber-400:oklch(.828 .189 84.429);--color-amber-500:oklch(.769 .188 70.08);--color-amber-600:oklch(.666 .179 58.318);--color-amber-700:oklch(.555 .163 48.998);--color-amber-800:oklch(.473 .137 46.201);--color-amber-900:oklch(.414 .112 45.904);--color-amber-950:oklch(.279 .077 45.635);--color-yellow-50:oklch(.987 .026 102.212);--color-yellow-100:oklch(.973 .071 103.193);--color-yellow-200:oklch(.945 .129 101.54);--color-yellow-300:oklch(.905 .182 98.111);--color-yellow-400:oklch(.852 .199 91.936);--color-yellow-500:oklch(.795 .184 86.047);--color-yellow-600:oklch(.681 .162 75.834);--color-yellow-700:oklch(.554 .135 66.442);--color-yellow-800:oklch(.476 .114 61.907);--color-yellow-900:oklch(.421 .095 57.708);--color-yellow-950:oklch(.286 .066 53.813);--color-lime-50:oklch(.986 .031 120.757);--color-lime-100:oklch(.967 .067 122.328);--color-lime-200:oklch(.938 .127 124.321);--color-lime-300:oklch(.897 .196 126.665);--color-lime-400:oklch(.841 .238 128.85);--color-lime-500:oklch(.768 .233 130.85);--color-lime-600:oklch(.648 .2 131.684);--color-lime-700:oklch(.532 .157 131.589);--color-lime-800:oklch(.453 .124 130.933);--color-lime-900:oklch(.405 .101 131.063);--color-lime-950:oklch(.274 .072 132.109);--color-green-50:oklch(.982 .018 155.826);--color-green-100:oklch(.962 .044 156.743);--color-green-200:oklch(.925 .084 155.995);--color-green-300:oklch(.871 .15 154.449);--color-green-400:oklch(.792 .209 151.711);--color-green-500:oklch(.723 .219 149.579);--color-green-600:oklch(.627 .194 149.214);--color-green-700:oklch(.527 .154 150.069);--color-green-800:oklch(.448 .119 151.328);--color-green-900:oklch(.393 .095 152.535);--color-green-950:oklch(.266 .065 152.934);--color-emerald-50:oklch(.979 .021 166.113);--color-emerald-100:oklch(.95 .052 163.051);--color-emerald-200:oklch(.905 .093 164.15);--color-emerald-300:oklch(.845 .143 164.978);--color-emerald-400:oklch(.765 .177 163.223);--color-emerald-500:oklch(.696 .17 162.48);--color-emerald-600:oklch(.596 .145 163.225);--color-emerald-700:oklch(.508 .118 165.612);--color-emerald-800:oklch(.432 .095 166.913);--color-emerald-900:oklch(.378 .077 168.94);--color-emerald-950:oklch(.262 .051 172.552);--color-teal-50:oklch(.984 .014 180.72);--color-teal-100:oklch(.953 .051 180.801);--color-teal-200:oklch(.91 .096 180.426);--color-teal-300:oklch(.855 .138 181.071);--color-teal-400:oklch(.777 .152 181.912);--color-teal-500:oklch(.704 .14 182.503);--color-teal-600:oklch(.6 .118 184.704);--color-teal-700:oklch(.511 .096 186.391);--color-teal-800:oklch(.437 .078 188.216);--color-teal-900:oklch(.386 .063 188.416);--color-teal-950:oklch(.277 .046 192.524);--color-cyan-50:oklch(.984 .019 200.873);--color-cyan-100:oklch(.956 .045 203.388);--color-cyan-200:oklch(.917 .08 205.041);--color-cyan-300:oklch(.865 .127 207.078);--color-cyan-400:oklch(.789 .154 211.53);--color-cyan-500:oklch(.715 .143 215.221);--color-cyan-600:oklch(.609 .126 221.723);--color-cyan-700:oklch(.52 .105 223.128);--color-cyan-800:oklch(.45 .085 224.283);--color-cyan-900:oklch(.398 .07 227.392);--color-cyan-950:oklch(.302 .056 229.695);--color-sky-50:oklch(.977 .013 236.62);--color-sky-100:oklch(.951 .026 236.824);--color-sky-200:oklch(.901 .058 230.902);--color-sky-300:oklch(.828 .111 230.318);--color-sky-400:oklch(.746 .16 232.661);--color-sky-500:oklch(.685 .169 237.323);--color-sky-600:oklch(.588 .158 241.966);--color-sky-700:oklch(.5 .134 242.749);--color-sky-800:oklch(.443 .11 240.79);--color-sky-900:oklch(.391 .09 240.876);--color-sky-950:oklch(.293 .066 243.157);--color-blue-50:oklch(.97 .014 254.604);--color-blue-100:oklch(.932 .032 255.585);--color-blue-200:oklch(.882 .059 254.128);--color-blue-300:oklch(.809 .105 251.813);--color-blue-400:oklch(.707 .165 254.624);--color-blue-500:oklch(.623 .214 259.815);--color-blue-600:oklch(.546 .245 262.881);--color-blue-700:oklch(.488 .243 264.376);--color-blue-800:oklch(.424 .199 265.638);--color-blue-900:oklch(.379 .146 265.522);--color-blue-950:oklch(.282 .091 267.935);--color-indigo-50:oklch(.962 .018 272.314);--color-indigo-100:oklch(.93 .034 272.788);--color-indigo-200:oklch(.87 .065 274.039);--color-indigo-300:oklch(.785 .115 274.713);--color-indigo-400:oklch(.673 .182 276.935);--color-indigo-500:oklch(.585 .233 277.117);--color-indigo-600:oklch(.511 .262 276.966);--color-indigo-700:oklch(.457 .24 277.023);--color-indigo-800:oklch(.398 .195 277.366);--color-indigo-900:oklch(.359 .144 278.697);--color-indigo-950:oklch(.257 .09 281.288);--color-violet-50:oklch(.969 .016 293.756);--color-violet-100:oklch(.943 .029 294.588);--color-violet-200:oklch(.894 .057 293.283);--color-violet-300:oklch(.811 .111 293.571);--color-violet-400:oklch(.702 .183 293.541);--color-violet-500:oklch(.606 .25 292.717);--color-violet-600:oklch(.541 .281 293.009);--color-violet-700:oklch(.491 .27 292.581);--color-violet-800:oklch(.432 .232 292.759);--color-violet-900:oklch(.38 .189 293.745);--color-violet-950:oklch(.283 .141 291.089);--color-purple-50:oklch(.977 .014 308.299);--color-purple-100:oklch(.946 .033 307.174);--color-purple-200:oklch(.902 .063 306.703);--color-purple-300:oklch(.827 .119 306.383);--color-purple-400:oklch(.714 .203 305.504);--color-purple-500:oklch(.627 .265 303.9);--color-purple-600:oklch(.558 .288 302.321);--color-purple-700:oklch(.496 .265 301.924);--color-purple-800:oklch(.438 .218 303.724);--color-purple-900:oklch(.381 .176 304.987);--color-purple-950:oklch(.291 .149 302.717);--color-fuchsia-50:oklch(.977 .017 320.058);--color-fuchsia-100:oklch(.952 .037 318.852);--color-fuchsia-200:oklch(.903 .076 319.62);--color-fuchsia-300:oklch(.833 .145 321.434);--color-fuchsia-400:oklch(.74 .238 322.16);--color-fuchsia-500:oklch(.667 .295 322.15);--color-fuchsia-600:oklch(.591 .293 322.896);--color-fuchsia-700:oklch(.518 .253 323.949);--color-fuchsia-800:oklch(.452 .211 324.591);--color-fuchsia-900:oklch(.401 .17 325.612);--color-fuchsia-950:oklch(.293 .136 325.661);--color-pink-50:oklch(.971 .014 343.198);--color-pink-100:oklch(.948 .028 342.258);--color-pink-200:oklch(.899 .061 343.231);--color-pink-300:oklch(.823 .12 346.018);--color-pink-400:oklch(.718 .202 349.761);--color-pink-500:oklch(.656 .241 354.308);--color-pink-600:oklch(.592 .249 .584);--color-pink-700:oklch(.525 .223 3.958);--color-pink-800:oklch(.459 .187 3.815);--color-pink-900:oklch(.408 .153 2.432);--color-pink-950:oklch(.284 .109 3.907);--color-rose-50:oklch(.969 .015 12.422);--color-rose-100:oklch(.941 .03 12.58);--color-rose-200:oklch(.892 .058 10.001);--color-rose-300:oklch(.81 .117 11.638);--color-rose-400:oklch(.712 .194 13.428);--color-rose-500:oklch(.645 .246 16.439);--color-rose-600:oklch(.586 .253 17.585);--color-rose-700:oklch(.514 .222 16.935);--color-rose-800:oklch(.455 .188 13.697);--color-rose-900:oklch(.41 .159 10.272);--color-rose-950:oklch(.271 .105 12.094);--color-slate-50:oklch(.984 .003 247.858);--color-slate-100:oklch(.968 .007 247.896);--color-slate-200:oklch(.929 .013 255.508);--color-slate-300:oklch(.869 .022 252.894);--color-slate-400:oklch(.704 .04 256.788);--color-slate-500:oklch(.554 .046 257.417);--color-slate-600:oklch(.446 .043 257.281);--color-slate-700:oklch(.372 .044 257.287);--color-slate-800:oklch(.279 .041 260.031);--color-slate-900:oklch(.208 .042 265.755);--color-slate-950:oklch(.129 .042 264.695);--color-gray-50:oklch(.985 .002 247.839);--color-gray-100:oklch(.967 .003 264.542);--color-gray-200:oklch(.928 .006 264.531);--color-gray-300:oklch(.872 .01 258.338);--color-gray-400:oklch(.707 .022 261.325);--color-gray-500:oklch(.551 .027 264.364);--color-gray-600:oklch(.446 .03 256.802);--color-gray-700:oklch(.373 .034 259.733);--color-gray-800:oklch(.278 .033 256.848);--color-gray-900:oklch(.21 .034 264.665);--color-gray-950:oklch(.13 .028 261.692);--color-zinc-50:oklch(.985 0 0);--color-zinc-100:oklch(.967 .001 286.375);--color-zinc-200:oklch(.92 .004 286.32);--color-zinc-300:oklch(.871 .006 286.286);--color-zinc-400:oklch(.705 .015 286.067);--color-zinc-500:oklch(.552 .016 285.938);--color-zinc-600:oklch(.442 .017 285.786);--color-zinc-700:oklch(.37 .013 285.805);--color-zinc-800:oklch(.274 .006 286.033);--color-zinc-900:oklch(.21 .006 285.885);--color-zinc-950:oklch(.141 .005 285.823);--color-neutral-50:oklch(.985 0 0);--color-neutral-100:oklch(.97 0 0);--color-neutral-200:oklch(.922 0 0);--color-neutral-300:oklch(.87 0 0);--color-neutral-400:oklch(.708 0 0);--color-neutral-500:oklch(.556 0 0);--color-neutral-600:oklch(.439 0 0);--color-neutral-700:oklch(.371 0 0);--color-neutral-800:oklch(.269 0 0);--color-neutral-900:oklch(.205 0 0);--color-neutral-950:oklch(.145 0 0);--color-stone-50:oklch(.985 .001 106.423);--color-stone-100:oklch(.97 .001 106.424);--color-stone-200:oklch(.923 .003 48.717);--color-stone-300:oklch(.869 .005 56.366);--color-stone-400:oklch(.709 .01 56.259);--color-stone-500:oklch(.553 .013 58.071);--color-stone-600:oklch(.444 .011 73.639);--color-stone-700:oklch(.374 .01 67.558);--color-stone-800:oklch(.268 .007 34.298);--color-stone-900:oklch(.216 .006 56.043);--color-stone-950:oklch(.147 .004 49.25);--color-black:#000;--color-white:#fff;--spacing:.25rem;--breakpoint-sm:40rem;--breakpoint-md:48rem;--breakpoint-lg:64rem;--breakpoint-xl:80rem;--breakpoint-2xl:96rem;--container-3xs:16rem;--container-2xs:18rem;--container-xs:20rem;--container-sm:24rem;--container-md:28rem;--container-lg:32rem;--container-xl:36rem;--container-2xl:42rem;--container-3xl:48rem;--container-4xl:56rem;--container-5xl:64rem;--container-6xl:72rem;--container-7xl:80rem;--text-xs:.75rem;--text-xs--line-height:calc(1/.75);--text-sm:.875rem;--text-sm--line-height:calc(1.25/.875);--text-base:1rem;--text-base--line-height: 1.5 ;--text-lg:1.125rem;--text-lg--line-height:calc(1.75/1.125);--text-xl:1.25rem;--text-xl--line-height:calc(1.75/1.25);--text-2xl:1.5rem;--text-2xl--line-height:calc(2/1.5);--text-3xl:1.875rem;--text-3xl--line-height: 1.2 ;--text-4xl:2.25rem;--text-4xl--line-height:calc(2.5/2.25);--text-5xl:3rem;--text-5xl--line-height:1;--text-6xl:3.75rem;--text-6xl--line-height:1;--text-7xl:4.5rem;--text-7xl--line-height:1;--text-8xl:6rem;--text-8xl--line-height:1;--text-9xl:8rem;--text-9xl--line-height:1;--font-weight-thin:100;--font-weight-extralight:200;--font-weight-light:300;--font-weight-normal:400;--font-weight-medium:500;--font-weight-semibold:600;--font-weight-bold:700;--font-weight-extrabold:800;--font-weight-black:900;--tracking-tighter:-.05em;--tracking-tight:-.025em;--tracking-normal:0em;--tracking-wide:.025em;--tracking-wider:.05em;--tracking-widest:.1em;--leading-tight:1.25;--leading-snug:1.375;--leading-normal:1.5;--leading-relaxed:1.625;--leading-loose:2;--radius-xs:.125rem;--radius-sm:.25rem;--radius-md:.375rem;--radius-lg:.5rem;--radius-xl:.75rem;--radius-2xl:1rem;--radius-3xl:1.5rem;--radius-4xl:2rem;--shadow-2xs:0 1px #0000000d;--shadow-xs:0 1px 2px 0 #0000000d;--shadow-sm:0 1px 3px 0 #0000001a,0 1px 2px -1px #0000001a;--shadow-md:0 4px 6px -1px #0000001a,0 2px 4px -2px #0000001a;--shadow-lg:0 10px 15px -3px #0000001a,0 4px 6px -4px #0000001a;--shadow-xl:0 20px 25px -5px #0000001a,0 8px 10px -6px #0000001a;--shadow-2xl:0 25px 50px -12px #00000040;--inset-shadow-2xs:inset 0 1px #0000000d;--inset-shadow-xs:inset 0 1px 1px #0000000d;--inset-shadow-sm:inset 0 2px 4px #0000000d;--drop-shadow-xs:0 1px 1px #0000000d;--drop-shadow-sm:0 1px 2px #00000026;--drop-shadow-md:0 3px 3px #0000001f;--drop-shadow-lg:0 4px 4px #00000026;--drop-shadow-xl:0 9px 7px #0000001a;--drop-shadow-2xl:0 25px 25px #00000026;--ease-in:cubic-bezier(.4,0,1,1);--ease-out:cubic-bezier(0,0,.2,1);--ease-in-out:cubic-bezier(.4,0,.2,1);--animate-spin:spin 1s linear infinite;--animate-ping:ping 1s cubic-bezier(0,0,.2,1)infinite;--animate-pulse:pulse 2s cubic-bezier(.4,0,.6,1)infinite;--animate-bounce:bounce 1s infinite;--blur-xs:4px;--blur-sm:8px;--blur-md:12px;--blur-lg:16px;--blur-xl:24px;--blur-2xl:40px;--blur-3xl:64px;--perspective-dramatic:100px;--perspective-near:300px;--perspective-normal:500px;--perspective-midrange:800px;--perspective-distant:1200px;--aspect-video:16/9;--default-transition-duration:.15s;--default-transition-timing-function:cubic-bezier(.4,0,.2,1);--default-font-family:var(--font-sans);--default-font-feature-settings:var(--font-sans--font-feature-settings);--default-font-variation-settings:var(--font-sans--font-variation-settings);--default-mono-font-family:var(--font-mono);--default-mono-font-feature-settings:var(--font-mono--font-feature-settings);--default-mono-font-variation-settings:var(--font-mono--font-variation-settings)}}@layer base{*,:after,:before,::backdrop{box-sizing:border-box;border:0 solid;margin:0;padding:0}::file-selector-button{box-sizing:border-box;border:0 solid;margin:0;padding:0}html,:host{-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;line-height:1.5;font-family:var(--default-font-family,ui-sans-serif,system-ui,sans-serif,&quot;Apple Color Emoji&quot;,&quot;Segoe UI Emoji&quot;,&quot;Segoe UI Symbol&quot;,&quot;Noto Color Emoji&quot;);font-feature-settings:var(--default-font-feature-settings,normal);font-variation-settings:var(--default-font-variation-settings,normal);-webkit-tap-highlight-color:transparent}body{line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;-webkit-text-decoration:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,samp,pre{font-family:var(--default-mono-font-family,ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,&quot;Liberation Mono&quot;,&quot;Courier New&quot;,monospace);font-feature-settings:var(--default-mono-font-feature-settings,normal);font-variation-settings:var(--default-mono-font-variation-settings,normal);font-size:1em}small{font-size:80%}sub,sup{vertical-align:baseline;font-size:75%;line-height:0;position:relative}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}:-moz-focusring{outline:auto}progress{vertical-align:baseline}summary{display:list-item}ol,ul,menu{list-style:none}img,svg,video,canvas,audio,iframe,embed,object{vertical-align:middle;display:block}img,video{max-width:100%;height:auto}button,input,select,optgroup,textarea{font:inherit;font-feature-settings:inherit;font-variation-settings:inherit;letter-spacing:inherit;color:inherit;opacity:1;background-color:#0000;border-radius:0}::file-selector-button{font:inherit;font-feature-settings:inherit;font-variation-settings:inherit;letter-spacing:inherit;color:inherit;opacity:1;background-color:#0000;border-radius:0}:where(select:is([multiple],[size])) optgroup{font-weight:bolder}:where(select:is([multiple],[size])) optgroup option{padding-inline-start:20px}::file-selector-button{margin-inline-end:4px}::placeholder{opacity:1;color:color-mix(in oklab,currentColor 50%,transparent)}textarea{resize:vertical}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-date-and-time-value{min-height:1lh;text-align:inherit}::-webkit-datetime-edit{display:inline-flex}::-webkit-datetime-edit-fields-wrapper{padding:0}::-webkit-datetime-edit{padding-block:0}::-webkit-datetime-edit-year-field{padding-block:0}::-webkit-datetime-edit-month-field{padding-block:0}::-webkit-datetime-edit-day-field{padding-block:0}::-webkit-datetime-edit-hour-field{padding-block:0}::-webkit-datetime-edit-minute-field{padding-block:0}::-webkit-datetime-edit-second-field{padding-block:0}::-webkit-datetime-edit-millisecond-field{padding-block:0}::-webkit-datetime-edit-meridiem-field{padding-block:0}:-moz-ui-invalid{box-shadow:none}button,input:where([type=button],[type=reset],[type=submit]){-webkit-appearance:button;-moz-appearance:button;appearance:button}::file-selector-button{-webkit-appearance:button;-moz-appearance:button;appearance:button}::-webkit-inner-spin-button{height:auto}::-webkit-outer-spin-button{height:auto}[hidden]:where(:not([hidden=until-found])){display:none!important}}@layer components;@layer utilities{.absolute{position:absolute}.relative{position:relative}.static{position:static}.inset-0{inset:calc(var(--spacing)*0)}.-mt-\[4\.9rem\]{margin-top:-4.9rem}.-mb-px{margin-bottom:-1px}.mb-1{margin-bottom:calc(var(--spacing)*1)}.mb-2{margin-bottom:calc(var(--spacing)*2)}.mb-4{margin-bottom:calc(var(--spacing)*4)}.mb-6{margin-bottom:calc(var(--spacing)*6)}.-ml-8{margin-left:calc(var(--spacing)*-8)}.flex{display:flex}.hidden{display:none}.inline-block{display:inline-block}.inline-flex{display:inline-flex}.table{display:table}.aspect-\[335\/376\]{aspect-ratio:335/376}.h-1{height:calc(var(--spacing)*1)}.h-1\.5{height:calc(var(--spacing)*1.5)}.h-2{height:calc(var(--spacing)*2)}.h-2\.5{height:calc(var(--spacing)*2.5)}.h-3{height:calc(var(--spacing)*3)}.h-3\.5{height:calc(var(--spacing)*3.5)}.h-14{height:calc(var(--spacing)*14)}.h-14\.5{height:calc(var(--spacing)*14.5)}.min-h-screen{min-height:100vh}.w-1{width:calc(var(--spacing)*1)}.w-1\.5{width:calc(var(--spacing)*1.5)}.w-2{width:calc(var(--spacing)*2)}.w-2\.5{width:calc(var(--spacing)*2.5)}.w-3{width:calc(var(--spacing)*3)}.w-3\.5{width:calc(var(--spacing)*3.5)}.w-\[448px\]{width:448px}.w-full{width:100%}.max-w-\[335px\]{max-width:335px}.max-w-none{max-width:none}.flex-1{flex:1}.shrink-0{flex-shrink:0}.translate-y-0{--tw-translate-y:calc(var(--spacing)*0);translate:var(--tw-translate-x)var(--tw-translate-y)}.transform{transform:var(--tw-rotate-x)var(--tw-rotate-y)var(--tw-rotate-z)var(--tw-skew-x)var(--tw-skew-y)}.flex-col{flex-direction:column}.flex-col-reverse{flex-direction:column-reverse}.items-center{align-items:center}.justify-center{justify-content:center}.justify-end{justify-content:flex-end}.gap-3{gap:calc(var(--spacing)*3)}.gap-4{gap:calc(var(--spacing)*4)}:where(.space-x-1&gt;:not(:last-child)){--tw-space-x-reverse:0;margin-inline-start:calc(calc(var(--spacing)*1)*var(--tw-space-x-reverse));margin-inline-end:calc(calc(var(--spacing)*1)*calc(1 - var(--tw-space-x-reverse)))}.overflow-hidden{overflow:hidden}.rounded-full{border-radius:3.40282e38px}.rounded-sm{border-radius:var(--radius-sm)}.rounded-t-lg{border-top-left-radius:var(--radius-lg);border-top-right-radius:var(--radius-lg)}.rounded-br-lg{border-bottom-right-radius:var(--radius-lg)}.rounded-bl-lg{border-bottom-left-radius:var(--radius-lg)}.border{border-style:var(--tw-border-style);border-width:1px}.border-\[\#19140035\]{border-color:#19140035}.border-\[\#e3e3e0\]{border-color:#e3e3e0}.border-black{border-color:var(--color-black)}.border-transparent{border-color:#0000}.bg-\[\#1b1b18\]{background-color:#1b1b18}.bg-\[\#FDFDFC\]{background-color:#fdfdfc}.bg-\[\#dbdbd7\]{background-color:#dbdbd7}.bg-\[\#fff2f2\]{background-color:#fff2f2}.bg-white{background-color:var(--color-white)}.p-6{padding:calc(var(--spacing)*6)}.px-5{padding-inline:calc(var(--spacing)*5)}.py-1{padding-block:calc(var(--spacing)*1)}.py-1\.5{padding-block:calc(var(--spacing)*1.5)}.py-2{padding-block:calc(var(--spacing)*2)}.pb-12{padding-bottom:calc(var(--spacing)*12)}.text-sm{font-size:var(--text-sm);line-height:var(--tw-leading,var(--text-sm--line-height))}.text-\[13px\]{font-size:13px}.leading-\[20px\]{--tw-leading:20px;line-height:20px}.leading-normal{--tw-leading:var(--leading-normal);line-height:var(--leading-normal)}.font-medium{--tw-font-weight:var(--font-weight-medium);font-weight:var(--font-weight-medium)}.text-\[\#1b1b18\]{color:#1b1b18}.text-\[\#706f6c\]{color:#706f6c}.text-\[\#F53003\],.text-\[\#f53003\]{color:#f53003}.text-white{color:var(--color-white)}.underline{text-decoration-line:underline}.underline-offset-4{text-underline-offset:4px}.opacity-100{opacity:1}.shadow-\[0px_0px_1px_0px_rgba\(0\,0\,0\,0\.03\)\,0px_1px_2px_0px_rgba\(0\,0\,0\,0\.06\)\]{--tw-shadow:0px 0px 1px 0px var(--tw-shadow-color,#00000008),0px 1px 2px 0px var(--tw-shadow-color,#0000000f);box-shadow:var(--tw-inset-shadow),var(--tw-inset-ring-shadow),var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow)}.shadow-\[inset_0px_0px_0px_1px_rgba\(26\,26\,0\,0\.16\)\]{--tw-shadow:inset 0px 0px 0px 1px var(--tw-shadow-color,#1a1a0029);box-shadow:var(--tw-inset-shadow),var(--tw-inset-ring-shadow),var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow)}.\!filter{filter:var(--tw-blur,)var(--tw-brightness,)var(--tw-contrast,)var(--tw-grayscale,)var(--tw-hue-rotate,)var(--tw-invert,)var(--tw-saturate,)var(--tw-sepia,)var(--tw-drop-shadow,)!important}.filter{filter:var(--tw-blur,)var(--tw-brightness,)var(--tw-contrast,)var(--tw-grayscale,)var(--tw-hue-rotate,)var(--tw-invert,)var(--tw-saturate,)var(--tw-sepia,)var(--tw-drop-shadow,)}.transition-all{transition-property:all;transition-timing-function:var(--tw-ease,var(--default-transition-timing-function));transition-duration:var(--tw-duration,var(--default-transition-duration))}.transition-opacity{transition-property:opacity;transition-timing-function:var(--tw-ease,var(--default-transition-timing-function));transition-duration:var(--tw-duration,var(--default-transition-duration))}.delay-300{transition-delay:.3s}.duration-750{--tw-duration:.75s;transition-duration:.75s}.not-has-\[nav\]\:hidden:not(:has(:is(nav))){display:none}.before\:absolute:before{content:var(--tw-content);position:absolute}.before\:top-0:before{content:var(--tw-content);top:calc(var(--spacing)*0)}.before\:top-1\/2:before{content:var(--tw-content);top:50%}.before\:bottom-0:before{content:var(--tw-content);bottom:calc(var(--spacing)*0)}.before\:bottom-1\/2:before{content:var(--tw-content);bottom:50%}.before\:left-\[0\.4rem\]:before{content:var(--tw-content);left:.4rem}.before\:border-l:before{content:var(--tw-content);border-left-style:var(--tw-border-style);border-left-width:1px}.before\:border-\[\#e3e3e0\]:before{content:var(--tw-content);border-color:#e3e3e0}@media (hover:hover){.hover\:border-\[\#1915014a\]:hover{border-color:#1915014a}.hover\:border-\[\#19140035\]:hover{border-color:#19140035}.hover\:border-black:hover{border-color:var(--color-black)}.hover\:bg-black:hover{background-color:var(--color-black)}}@media (width&gt;=64rem){.lg\:-mt-\[6\.6rem\]{margin-top:-6.6rem}.lg\:mb-0{margin-bottom:calc(var(--spacing)*0)}.lg\:mb-6{margin-bottom:calc(var(--spacing)*6)}.lg\:-ml-px{margin-left:-1px}.lg\:ml-0{margin-left:calc(var(--spacing)*0)}.lg\:block{display:block}.lg\:aspect-auto{aspect-ratio:auto}.lg\:w-\[438px\]{width:438px}.lg\:max-w-4xl{max-width:var(--container-4xl)}.lg\:grow{flex-grow:1}.lg\:flex-row{flex-direction:row}.lg\:justify-center{justify-content:center}.lg\:rounded-t-none{border-top-left-radius:0;border-top-right-radius:0}.lg\:rounded-tl-lg{border-top-left-radius:var(--radius-lg)}.lg\:rounded-r-lg{border-top-right-radius:var(--radius-lg);border-bottom-right-radius:var(--radius-lg)}.lg\:rounded-br-none{border-bottom-right-radius:0}.lg\:p-8{padding:calc(var(--spacing)*8)}.lg\:p-20{padding:calc(var(--spacing)*20)}}@media (prefers-color-scheme:dark){.dark\:block{display:block}.dark\:hidden{display:none}.dark\:border-\[\#3E3E3A\]{border-color:#3e3e3a}.dark\:border-\[\#eeeeec\]{border-color:#eeeeec}.dark\:bg-\[\#0a0a0a\]{background-color:#0a0a0a}.dark\:bg-\[\#1D0002\]{background-color:#1d0002}.dark\:bg-\[\#3E3E3A\]{background-color:#3e3e3a}.dark\:bg-\[\#161615\]{background-color:#161615}.dark\:bg-\[\#eeeeec\]{background-color:#eeeeec}.dark\:text-\[\#1C1C1A\]{color:#1c1c1a}.dark\:text-\[\#A1A09A\]{color:#a1a09a}.dark\:text-\[\#EDEDEC\]{color:#ededec}.dark\:text-\[\#F61500\]{color:#f61500}.dark\:text-\[\#FF4433\]{color:#f43}.dark\:shadow-\[inset_0px_0px_0px_1px_\#fffaed2d\]{--tw-shadow:inset 0px 0px 0px 1px var(--tw-shadow-color,#fffaed2d);box-shadow:var(--tw-inset-shadow),var(--tw-inset-ring-shadow),var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow)}.dark\:before\:border-\[\#3E3E3A\]:before{content:var(--tw-content);border-color:#3e3e3a}@media (hover:hover){.dark\:hover\:border-\[\#3E3E3A\]:hover{border-color:#3e3e3a}.dark\:hover\:border-\[\#62605b\]:hover{border-color:#62605b}.dark\:hover\:border-white:hover{border-color:var(--color-white)}.dark\:hover\:bg-white:hover{background-color:var(--color-white)}}}@starting-style{.starting\:translate-y-4{--tw-translate-y:calc(var(--spacing)*4);translate:var(--tw-translate-x)var(--tw-translate-y)}}@starting-style{.starting\:translate-y-6{--tw-translate-y:calc(var(--spacing)*6);translate:var(--tw-translate-x)var(--tw-translate-y)}}@starting-style{.starting\:opacity-0{opacity:0}}}@keyframes spin{to{transform:rotate(360deg)}}@keyframes ping{75%,to{opacity:0;transform:scale(2)}}@keyframes pulse{50%{opacity:.5}}@keyframes bounce{0%,to{animation-timing-function:cubic-bezier(.8,0,1,1);transform:translateY(-25%)}50%{animation-timing-function:cubic-bezier(0,0,.2,1);transform:none}}@property --tw-translate-x{syntax:&quot;*&quot;;inherits:false;initial-value:0}@property --tw-translate-y{syntax:&quot;*&quot;;inherits:false;initial-value:0}@property --tw-translate-z{syntax:&quot;*&quot;;inherits:false;initial-value:0}@property --tw-rotate-x{syntax:&quot;*&quot;;inherits:false;initial-value:rotateX(0)}@property --tw-rotate-y{syntax:&quot;*&quot;;inherits:false;initial-value:rotateY(0)}@property --tw-rotate-z{syntax:&quot;*&quot;;inherits:false;initial-value:rotateZ(0)}@property --tw-skew-x{syntax:&quot;*&quot;;inherits:false;initial-value:skewX(0)}@property --tw-skew-y{syntax:&quot;*&quot;;inherits:false;initial-value:skewY(0)}@property --tw-space-x-reverse{syntax:&quot;*&quot;;inherits:false;initial-value:0}@property --tw-border-style{syntax:&quot;*&quot;;inherits:false;initial-value:solid}@property --tw-leading{syntax:&quot;*&quot;;inherits:false}@property --tw-font-weight{syntax:&quot;*&quot;;inherits:false}@property --tw-shadow{syntax:&quot;*&quot;;inherits:false;initial-value:0 0 #0000}@property --tw-shadow-color{syntax:&quot;*&quot;;inherits:false}@property --tw-inset-shadow{syntax:&quot;*&quot;;inherits:false;initial-value:0 0 #0000}@property --tw-inset-shadow-color{syntax:&quot;*&quot;;inherits:false}@property --tw-ring-color{syntax:&quot;*&quot;;inherits:false}@property --tw-ring-shadow{syntax:&quot;*&quot;;inherits:false;initial-value:0 0 #0000}@property --tw-inset-ring-color{syntax:&quot;*&quot;;inherits:false}@property --tw-inset-ring-shadow{syntax:&quot;*&quot;;inherits:false;initial-value:0 0 #0000}@property --tw-ring-inset{syntax:&quot;*&quot;;inherits:false}@property --tw-ring-offset-width{syntax:&quot;&lt;length&gt;&quot;;inherits:false;initial-value:0}@property --tw-ring-offset-color{syntax:&quot;*&quot;;inherits:false;initial-value:#fff}@property --tw-ring-offset-shadow{syntax:&quot;*&quot;;inherits:false;initial-value:0 0 #0000}@property --tw-blur{syntax:&quot;*&quot;;inherits:false}@property --tw-brightness{syntax:&quot;*&quot;;inherits:false}@property --tw-contrast{syntax:&quot;*&quot;;inherits:false}@property --tw-grayscale{syntax:&quot;*&quot;;inherits:false}@property --tw-hue-rotate{syntax:&quot;*&quot;;inherits:false}@property --tw-invert{syntax:&quot;*&quot;;inherits:false}@property --tw-opacity{syntax:&quot;*&quot;;inherits:false}@property --tw-saturate{syntax:&quot;*&quot;;inherits:false}@property --tw-sepia{syntax:&quot;*&quot;;inherits:false}@property --tw-drop-shadow{syntax:&quot;*&quot;;inherits:false}@property --tw-duration{syntax:&quot;*&quot;;inherits:false}@property --tw-content{syntax:&quot;*&quot;;inherits:false;initial-value:&quot;&quot;}
            &lt;/style&gt;
            &lt;/head&gt;
    &lt;body class=&quot;bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col&quot;&gt;
        &lt;header class=&quot;w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden&quot;&gt;
                            &lt;nav class=&quot;flex items-center justify-end gap-4&quot;&gt;
                                            &lt;a
                            href=&quot;http://localhost/login&quot;
                            class=&quot;inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal&quot;
                        &gt;
                            Log in
                        &lt;/a&gt;

                                                    &lt;a
                                href=&quot;http://localhost/register&quot;
                                class=&quot;inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal&quot;&gt;
                                Register
                            &lt;/a&gt;
                                                            &lt;/nav&gt;
                    &lt;/header&gt;
        &lt;div class=&quot;flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0&quot;&gt;
            &lt;main class=&quot;flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row&quot;&gt;
                &lt;div class=&quot;text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none&quot;&gt;
                    &lt;h1 class=&quot;mb-1 font-medium&quot;&gt;Let&#039;s get started&lt;/h1&gt;
                    &lt;p class=&quot;mb-2 text-[#706f6c] dark:text-[#A1A09A]&quot;&gt;Laravel has an incredibly rich ecosystem. &lt;br&gt;We suggest starting with the following.&lt;/p&gt;
                    &lt;ul class=&quot;flex flex-col mb-4 lg:mb-6&quot;&gt;
                        &lt;li class=&quot;flex items-center gap-4 py-2 relative before:border-l before:border-[#e3e3e0] dark:before:border-[#3E3E3A] before:top-1/2 before:bottom-0 before:left-[0.4rem] before:absolute&quot;&gt;
                            &lt;span class=&quot;relative py-1 bg-white dark:bg-[#161615]&quot;&gt;
                                &lt;span class=&quot;flex items-center justify-center rounded-full bg-[#FDFDFC] dark:bg-[#161615] shadow-[0px_0px_1px_0px_rgba(0,0,0,0.03),0px_1px_2px_0px_rgba(0,0,0,0.06)] w-3.5 h-3.5 border dark:border-[#3E3E3A] border-[#e3e3e0]&quot;&gt;
                                    &lt;span class=&quot;rounded-full bg-[#dbdbd7] dark:bg-[#3E3E3A] w-1.5 h-1.5&quot;&gt;&lt;/span&gt;
                                &lt;/span&gt;
                            &lt;/span&gt;
                            &lt;span&gt;
                                Read the
                                &lt;a href=&quot;https://laravel.com/docs&quot; target=&quot;_blank&quot; class=&quot;inline-flex items-center space-x-1 font-medium underline underline-offset-4 text-[#f53003] dark:text-[#FF4433] ml-1&quot;&gt;
                                    &lt;span&gt;Documentation&lt;/span&gt;
                                    &lt;svg
                                        width=&quot;10&quot;
                                        height=&quot;11&quot;
                                        viewBox=&quot;0 0 10 11&quot;
                                        fill=&quot;none&quot;
                                        xmlns=&quot;http://www.w3.org/2000/svg&quot;
                                        class=&quot;w-2.5 h-2.5&quot;
                                    &gt;
                                        &lt;path
                                            d=&quot;M7.70833 6.95834V2.79167H3.54167M2.5 8L7.5 3.00001&quot;
                                            stroke=&quot;currentColor&quot;
                                            stroke-linecap=&quot;square&quot;
                                        /&gt;
                                    &lt;/svg&gt;
                                &lt;/a&gt;
                            &lt;/span&gt;
                        &lt;/li&gt;
                        &lt;li class=&quot;flex items-center gap-4 py-2 relative before:border-l before:border-[#e3e3e0] dark:before:border-[#3E3E3A] before:bottom-1/2 before:top-0 before:left-[0.4rem] before:absolute&quot;&gt;
                            &lt;span class=&quot;relative py-1 bg-white dark:bg-[#161615]&quot;&gt;
                                &lt;span class=&quot;flex items-center justify-center rounded-full bg-[#FDFDFC] dark:bg-[#161615] shadow-[0px_0px_1px_0px_rgba(0,0,0,0.03),0px_1px_2px_0px_rgba(0,0,0,0.06)] w-3.5 h-3.5 border dark:border-[#3E3E3A] border-[#e3e3e0]&quot;&gt;
                                    &lt;span class=&quot;rounded-full bg-[#dbdbd7] dark:bg-[#3E3E3A] w-1.5 h-1.5&quot;&gt;&lt;/span&gt;
                                &lt;/span&gt;
                            &lt;/span&gt;
                            &lt;span&gt;
                                Watch video tutorials at
                                &lt;a href=&quot;https://laracasts.com&quot; target=&quot;_blank&quot; class=&quot;inline-flex items-center space-x-1 font-medium underline underline-offset-4 text-[#f53003] dark:text-[#FF4433] ml-1&quot;&gt;
                                    &lt;span&gt;Laracasts&lt;/span&gt;
                                    &lt;svg
                                        width=&quot;10&quot;
                                        height=&quot;11&quot;
                                        viewBox=&quot;0 0 10 11&quot;
                                        fill=&quot;none&quot;
                                        xmlns=&quot;http://www.w3.org/2000/svg&quot;
                                        class=&quot;w-2.5 h-2.5&quot;
                                    &gt;
                                        &lt;path
                                            d=&quot;M7.70833 6.95834V2.79167H3.54167M2.5 8L7.5 3.00001&quot;
                                            stroke=&quot;currentColor&quot;
                                            stroke-linecap=&quot;square&quot;
                                        /&gt;
                                    &lt;/svg&gt;
                                &lt;/a&gt;
                            &lt;/span&gt;
                        &lt;/li&gt;
                    &lt;/ul&gt;
                    &lt;ul class=&quot;flex gap-3 text-sm leading-normal&quot;&gt;
                        &lt;li&gt;
                            &lt;a href=&quot;https://cloud.laravel.com&quot; target=&quot;_blank&quot; class=&quot;inline-block dark:bg-[#eeeeec] dark:border-[#eeeeec] dark:text-[#1C1C1A] dark:hover:bg-white dark:hover:border-white hover:bg-black hover:border-black px-5 py-1.5 bg-[#1b1b18] rounded-sm border border-black text-white text-sm leading-normal&quot;&gt;
                                Deploy now
                            &lt;/a&gt;
                        &lt;/li&gt;
                    &lt;/ul&gt;
                &lt;/div&gt;
                &lt;div class=&quot;bg-[#fff2f2] dark:bg-[#1D0002] relative lg:-ml-px -mb-px lg:mb-0 rounded-t-lg lg:rounded-t-none lg:rounded-r-lg aspect-[335/376] lg:aspect-auto w-full lg:w-[438px] shrink-0 overflow-hidden&quot;&gt;
                    
                    &lt;svg class=&quot;w-full text-[#F53003] dark:text-[#F61500] transition-all translate-y-0 opacity-100 max-w-none duration-750 starting:opacity-0 starting:translate-y-6&quot; viewBox=&quot;0 0 438 104&quot; fill=&quot;none&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;&gt;
                        &lt;path d=&quot;M17.2036 -3H0V102.197H49.5189V86.7187H17.2036V-3Z&quot; fill=&quot;currentColor&quot; /&gt;
                        &lt;path d=&quot;M110.256 41.6337C108.061 38.1275 104.945 35.3731 100.905 33.3681C96.8667 31.3647 92.8016 30.3618 88.7131 30.3618C83.4247 30.3618 78.5885 31.3389 74.201 33.2923C69.8111 35.2456 66.0474 37.928 62.9059 41.3333C59.7643 44.7401 57.3198 48.6726 55.5754 53.1293C53.8287 57.589 52.9572 62.274 52.9572 67.1813C52.9572 72.1925 53.8287 76.8995 55.5754 81.3069C57.3191 85.7173 59.7636 89.6241 62.9059 93.0293C66.0474 96.4361 69.8119 99.1155 74.201 101.069C78.5885 103.022 83.4247 103.999 88.7131 103.999C92.8016 103.999 96.8667 102.997 100.905 100.994C104.945 98.9911 108.061 96.2359 110.256 92.7282V102.195H126.563V32.1642H110.256V41.6337ZM108.76 75.7472C107.762 78.4531 106.366 80.8078 104.572 82.8112C102.776 84.8161 100.606 86.4183 98.0637 87.6206C95.5202 88.823 92.7004 89.4238 89.6103 89.4238C86.5178 89.4238 83.7252 88.823 81.2324 87.6206C78.7388 86.4183 76.5949 84.8161 74.7998 82.8112C73.004 80.8078 71.6319 78.4531 70.6856 75.7472C69.7356 73.0421 69.2644 70.1868 69.2644 67.1821C69.2644 64.1758 69.7356 61.3205 70.6856 58.6154C71.6319 55.9102 73.004 53.5571 74.7998 51.5522C76.5949 49.5495 78.738 47.9451 81.2324 46.7427C83.7252 45.5404 86.5178 44.9396 89.6103 44.9396C92.7012 44.9396 95.5202 45.5404 98.0637 46.7427C100.606 47.9451 102.776 49.5487 104.572 51.5522C106.367 53.5571 107.762 55.9102 108.76 58.6154C109.756 61.3205 110.256 64.1758 110.256 67.1821C110.256 70.1868 109.756 73.0421 108.76 75.7472Z&quot; fill=&quot;currentColor&quot; /&gt;
                        &lt;path d=&quot;M242.805 41.6337C240.611 38.1275 237.494 35.3731 233.455 33.3681C229.416 31.3647 225.351 30.3618 221.262 30.3618C215.974 30.3618 211.138 31.3389 206.75 33.2923C202.36 35.2456 198.597 37.928 195.455 41.3333C192.314 44.7401 189.869 48.6726 188.125 53.1293C186.378 57.589 185.507 62.274 185.507 67.1813C185.507 72.1925 186.378 76.8995 188.125 81.3069C189.868 85.7173 192.313 89.6241 195.455 93.0293C198.597 96.4361 202.361 99.1155 206.75 101.069C211.138 103.022 215.974 103.999 221.262 103.999C225.351 103.999 229.416 102.997 233.455 100.994C237.494 98.9911 240.611 96.2359 242.805 92.7282V102.195H259.112V32.1642H242.805V41.6337ZM241.31 75.7472C240.312 78.4531 238.916 80.8078 237.122 82.8112C235.326 84.8161 233.156 86.4183 230.614 87.6206C228.07 88.823 225.251 89.4238 222.16 89.4238C219.068 89.4238 216.275 88.823 213.782 87.6206C211.289 86.4183 209.145 84.8161 207.35 82.8112C205.554 80.8078 204.182 78.4531 203.236 75.7472C202.286 73.0421 201.814 70.1868 201.814 67.1821C201.814 64.1758 202.286 61.3205 203.236 58.6154C204.182 55.9102 205.554 53.5571 207.35 51.5522C209.145 49.5495 211.288 47.9451 213.782 46.7427C216.275 45.5404 219.068 44.9396 222.16 44.9396C225.251 44.9396 228.07 45.5404 230.614 46.7427C233.156 47.9451 235.326 49.5487 237.122 51.5522C238.917 53.5571 240.312 55.9102 241.31 58.6154C242.306 61.3205 242.806 64.1758 242.806 67.1821C242.805 70.1868 242.305 73.0421 241.31 75.7472Z&quot; fill=&quot;currentColor&quot; /&gt;
                        &lt;path d=&quot;M438 -3H421.694V102.197H438V-3Z&quot; fill=&quot;currentColor&quot; /&gt;
                        &lt;path d=&quot;M139.43 102.197H155.735V48.2834H183.712V32.1665H139.43V102.197Z&quot; fill=&quot;currentColor&quot; /&gt;
                        &lt;path d=&quot;M324.49 32.1665L303.995 85.794L283.498 32.1665H266.983L293.748 102.197H314.242L341.006 32.1665H324.49Z&quot; fill=&quot;currentColor&quot; /&gt;
                        &lt;path d=&quot;M376.571 30.3656C356.603 30.3656 340.797 46.8497 340.797 67.1828C340.797 89.6597 356.094 104 378.661 104C391.29 104 399.354 99.1488 409.206 88.5848L398.189 80.0226C398.183 80.031 389.874 90.9895 377.468 90.9895C363.048 90.9895 356.977 79.3111 356.977 73.269H411.075C413.917 50.1328 398.775 30.3656 376.571 30.3656ZM357.02 61.0967C357.145 59.7487 359.023 43.3761 376.442 43.3761C393.861 43.3761 395.978 59.7464 396.099 61.0967H357.02Z&quot; fill=&quot;currentColor&quot; /&gt;
                    &lt;/svg&gt;

                    
                    &lt;svg class=&quot;w-[448px] max-w-none relative -mt-[4.9rem] -ml-8 lg:ml-0 lg:-mt-[6.6rem] dark:hidden&quot; viewBox=&quot;0 0 440 376&quot; fill=&quot;none&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;&gt;
                        &lt;g class=&quot;transition-all delay-300 translate-y-0 opacity-100 duration-750 starting:opacity-0 starting:translate-y-4&quot;&gt;
                            &lt;path d=&quot;M188.263 355.73L188.595 355.73C195.441 348.845 205.766 339.761 219.569 328.477C232.93 317.193 242.978 308.205 249.714 301.511C256.34 294.626 260.867 287.358 263.296 279.708C265.725 272.058 264.565 264.121 259.816 255.896C254.516 246.716 247.062 239.352 237.454 233.805C227.957 228.067 217.908 225.198 207.307 225.198C196.927 225.197 190.136 227.97 186.934 233.516C183.621 238.872 184.726 246.331 190.247 255.894L125.647 255.891C116.371 239.825 112.395 225.481 113.72 212.858C115.265 200.235 121.559 190.481 132.602 183.596C143.754 176.52 158.607 172.982 177.159 172.983C196.594 172.984 215.863 176.523 234.968 183.6C253.961 190.486 271.299 200.241 286.98 212.864C302.661 225.488 315.14 239.833 324.416 255.899C333.03 270.817 336.841 283.918 335.847 295.203C335.075 306.487 331.376 316.336 324.75 324.751C318.346 333.167 308.408 343.494 294.936 355.734L377.094 355.737L405.917 405.656L217.087 405.649L188.263 355.73Z&quot; fill=&quot;black&quot; /&gt;
                            &lt;path d=&quot;M9.11884 226.339L-13.7396 226.338L-42.7286 176.132L43.0733 176.135L175.595 405.649L112.651 405.647L9.11884 226.339Z&quot; fill=&quot;black&quot; /&gt;
                            &lt;path d=&quot;M188.263 355.73L188.595 355.73C195.441 348.845 205.766 339.761 219.569 328.477C232.93 317.193 242.978 308.205 249.714 301.511C256.34 294.626 260.867 287.358 263.296 279.708C265.725 272.058 264.565 264.121 259.816 255.896C254.516 246.716 247.062 239.352 237.454 233.805C227.957 228.067 217.908 225.198 207.307 225.198C196.927 225.197 190.136 227.97 186.934 233.516C183.621 238.872 184.726 246.331 190.247 255.894L125.647 255.891C116.371 239.825 112.395 225.481 113.72 212.858C115.265 200.235 121.559 190.481 132.602 183.596C143.754 176.52 158.607 172.982 177.159 172.983C196.594 172.984 215.863 176.523 234.968 183.6C253.961 190.486 271.299 200.241 286.98 212.864C302.661 225.488 315.14 239.833 324.416 255.899C333.03 270.817 336.841 283.918 335.847 295.203C335.075 306.487 331.376 316.336 324.75 324.751C318.346 333.167 308.408 343.494 294.936 355.734L377.094 355.737L405.917 405.656L217.087 405.649L188.263 355.73Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; /&gt;
                            &lt;path d=&quot;M9.11884 226.339L-13.7396 226.338L-42.7286 176.132L43.0733 176.135L175.595 405.649L112.651 405.647L9.11884 226.339Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; /&gt;
                            &lt;path d=&quot;M204.592 327.449L204.923 327.449C211.769 320.564 222.094 311.479 235.897 300.196C249.258 288.912 259.306 279.923 266.042 273.23C272.668 266.345 277.195 259.077 279.624 251.427C282.053 243.777 280.893 235.839 276.145 227.615C270.844 218.435 263.39 211.071 253.782 205.524C244.285 199.786 234.236 196.917 223.635 196.916C213.255 196.916 206.464 199.689 203.262 205.235C199.949 210.59 201.054 218.049 206.575 227.612L141.975 227.61C132.699 211.544 128.723 197.2 130.048 184.577C131.593 171.954 137.887 162.2 148.93 155.315C160.083 148.239 174.935 144.701 193.487 144.702C212.922 144.703 232.192 148.242 251.296 155.319C270.289 162.205 287.627 171.96 303.308 184.583C318.989 197.207 331.468 211.552 340.745 227.618C349.358 242.536 353.169 255.637 352.175 266.921C351.403 278.205 347.704 288.055 341.078 296.47C334.674 304.885 324.736 315.213 311.264 327.453L393.422 327.456L422.246 377.375L233.415 377.368L204.592 327.449Z&quot; fill=&quot;#F8B803&quot; /&gt;
                            &lt;path d=&quot;M25.447 198.058L2.58852 198.057L-26.4005 147.851L59.4015 147.854L191.923 377.368L128.979 377.365L25.447 198.058Z&quot; fill=&quot;#F8B803&quot; /&gt;
                            &lt;path d=&quot;M204.592 327.449L204.923 327.449C211.769 320.564 222.094 311.479 235.897 300.196C249.258 288.912 259.306 279.923 266.042 273.23C272.668 266.345 277.195 259.077 279.624 251.427C282.053 243.777 280.893 235.839 276.145 227.615C270.844 218.435 263.39 211.071 253.782 205.524C244.285 199.786 234.236 196.917 223.635 196.916C213.255 196.916 206.464 199.689 203.262 205.235C199.949 210.59 201.054 218.049 206.575 227.612L141.975 227.61C132.699 211.544 128.723 197.2 130.048 184.577C131.593 171.954 137.887 162.2 148.93 155.315C160.083 148.239 174.935 144.701 193.487 144.702C212.922 144.703 232.192 148.242 251.296 155.319C270.289 162.205 287.627 171.96 303.308 184.583C318.989 197.207 331.468 211.552 340.745 227.618C349.358 242.536 353.169 255.637 352.175 266.921C351.403 278.205 347.704 288.055 341.078 296.47C334.674 304.885 324.736 315.213 311.264 327.453L393.422 327.456L422.246 377.375L233.415 377.368L204.592 327.449Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; /&gt;
                            &lt;path d=&quot;M25.447 198.058L2.58852 198.057L-26.4005 147.851L59.4015 147.854L191.923 377.368L128.979 377.365L25.447 198.058Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; /&gt;
                        &lt;/g&gt;
                        &lt;g style=&quot;mix-blend-mode: hard-light&quot; class=&quot;transition-all delay-300 translate-y-0 opacity-100 duration-750 starting:opacity-0 starting:translate-y-4&quot;&gt;
                            &lt;path d=&quot;M217.342 305.363L217.673 305.363C224.519 298.478 234.844 289.393 248.647 278.11C262.008 266.826 272.056 257.837 278.792 251.144C285.418 244.259 289.945 236.991 292.374 229.341C294.803 221.691 293.643 213.753 288.895 205.529C283.594 196.349 276.14 188.985 266.532 183.438C257.035 177.7 246.986 174.831 236.385 174.83C226.005 174.83 219.214 177.603 216.012 183.149C212.699 188.504 213.804 195.963 219.325 205.527L154.725 205.524C145.449 189.458 141.473 175.114 142.798 162.491C144.343 149.868 150.637 140.114 161.68 133.229C172.833 126.153 187.685 122.615 206.237 122.616C225.672 122.617 244.942 126.156 264.046 133.233C283.039 140.119 300.377 149.874 316.058 162.497C331.739 175.121 344.218 189.466 353.495 205.532C362.108 220.45 365.919 233.551 364.925 244.835C364.153 256.12 360.454 265.969 353.828 274.384C347.424 282.799 337.486 293.127 324.014 305.367L406.172 305.37L434.996 355.289L246.165 355.282L217.342 305.363Z&quot; fill=&quot;#F0ACB8&quot; /&gt;
                            &lt;path d=&quot;M38.197 175.972L15.3385 175.971L-13.6505 125.765L72.1515 125.768L204.673 355.282L141.729 355.279L38.197 175.972Z&quot; fill=&quot;#F0ACB8&quot; /&gt;
                            &lt;path d=&quot;M217.342 305.363L217.673 305.363C224.519 298.478 234.844 289.393 248.647 278.11C262.008 266.826 272.056 257.837 278.792 251.144C285.418 244.259 289.945 236.991 292.374 229.341C294.803 221.691 293.643 213.753 288.895 205.529C283.594 196.349 276.14 188.985 266.532 183.438C257.035 177.7 246.986 174.831 236.385 174.83C226.005 174.83 219.214 177.603 216.012 183.149C212.699 188.504 213.804 195.963 219.325 205.527L154.725 205.524C145.449 189.458 141.473 175.114 142.798 162.491C144.343 149.868 150.637 140.114 161.68 133.229C172.833 126.153 187.685 122.615 206.237 122.616C225.672 122.617 244.942 126.156 264.046 133.233C283.039 140.119 300.377 149.874 316.058 162.497C331.739 175.121 344.218 189.466 353.495 205.532C362.108 220.45 365.919 233.551 364.925 244.835C364.153 256.12 360.454 265.969 353.828 274.384C347.424 282.799 337.486 293.127 324.014 305.367L406.172 305.37L434.996 355.289L246.165 355.282L217.342 305.363Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; /&gt;
                            &lt;path d=&quot;M38.197 175.972L15.3385 175.971L-13.6505 125.765L72.1515 125.768L204.673 355.282L141.729 355.279L38.197 175.972Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; /&gt;
                        &lt;/g&gt;
                        &lt;g style=&quot;mix-blend-mode: plus-darker&quot; class=&quot;transition-all delay-300 translate-y-0 opacity-100 duration-750 starting:opacity-0 starting:translate-y-4&quot;&gt;
                            &lt;path d=&quot;M230.951 281.792L231.282 281.793C238.128 274.907 248.453 265.823 262.256 254.539C275.617 243.256 285.666 234.267 292.402 227.573C299.027 220.688 303.554 213.421 305.983 205.771C308.412 198.12 307.253 190.183 302.504 181.959C297.203 172.778 289.749 165.415 280.142 159.868C270.645 154.13 260.596 151.26 249.995 151.26C239.615 151.26 232.823 154.033 229.621 159.579C226.309 164.934 227.413 172.393 232.935 181.956L168.335 181.954C159.058 165.888 155.082 151.543 156.407 138.92C157.953 126.298 164.247 116.544 175.289 109.659C186.442 102.583 201.294 99.045 219.846 99.0457C239.281 99.0464 258.551 102.585 277.655 109.663C296.649 116.549 313.986 126.303 329.667 138.927C345.349 151.551 357.827 165.895 367.104 181.961C375.718 196.88 379.528 209.981 378.535 221.265C377.762 232.549 374.063 242.399 367.438 250.814C361.033 259.229 351.095 269.557 337.624 281.796L419.782 281.8L448.605 331.719L259.774 331.712L230.951 281.792Z&quot; fill=&quot;#F3BEC7&quot; /&gt;
                            &lt;path d=&quot;M51.8063 152.402L28.9479 152.401L-0.0411453 102.195L85.7608 102.198L218.282 331.711L155.339 331.709L51.8063 152.402Z&quot; fill=&quot;#F3BEC7&quot; /&gt;
                            &lt;path d=&quot;M230.951 281.792L231.282 281.793C238.128 274.907 248.453 265.823 262.256 254.539C275.617 243.256 285.666 234.267 292.402 227.573C299.027 220.688 303.554 213.421 305.983 205.771C308.412 198.12 307.253 190.183 302.504 181.959C297.203 172.778 289.749 165.415 280.142 159.868C270.645 154.13 260.596 151.26 249.995 151.26C239.615 151.26 232.823 154.033 229.621 159.579C226.309 164.934 227.413 172.393 232.935 181.956L168.335 181.954C159.058 165.888 155.082 151.543 156.407 138.92C157.953 126.298 164.247 116.544 175.289 109.659C186.442 102.583 201.294 99.045 219.846 99.0457C239.281 99.0464 258.551 102.585 277.655 109.663C296.649 116.549 313.986 126.303 329.667 138.927C345.349 151.551 357.827 165.895 367.104 181.961C375.718 196.88 379.528 209.981 378.535 221.265C377.762 232.549 374.063 242.399 367.438 250.814C361.033 259.229 351.095 269.557 337.624 281.796L419.782 281.8L448.605 331.719L259.774 331.712L230.951 281.792Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; /&gt;
                            &lt;path d=&quot;M51.8063 152.402L28.9479 152.401L-0.0411453 102.195L85.7608 102.198L218.282 331.711L155.339 331.709L51.8063 152.402Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; /&gt;
                        &lt;/g&gt;
                        &lt;g class=&quot;transition-all delay-300 translate-y-0 opacity-100 duration-750 starting:opacity-0 starting:translate-y-4&quot;&gt;
                            &lt;path d=&quot;M188.467 355.363L188.798 355.363C195.644 348.478 205.969 339.393 219.772 328.11C233.133 316.826 243.181 307.837 249.917 301.144C253.696 297.217 256.792 293.166 259.205 288.991C261.024 285.845 262.455 282.628 263.499 279.341C265.928 271.691 264.768 263.753 260.02 255.529C254.719 246.349 247.265 238.985 237.657 233.438C228.16 227.7 218.111 224.831 207.51 224.83C197.13 224.83 190.339 227.603 187.137 233.149C183.824 238.504 184.929 245.963 190.45 255.527L125.851 255.524C116.574 239.458 112.598 225.114 113.923 212.491C114.615 206.836 116.261 201.756 118.859 197.253C122.061 191.704 126.709 187.03 132.805 183.229C143.958 176.153 158.81 172.615 177.362 172.616C196.797 172.617 216.067 176.156 235.171 183.233C254.164 190.119 271.502 199.874 287.183 212.497C302.864 225.121 315.343 239.466 324.62 255.532C333.233 270.45 337.044 283.551 336.05 294.835C335.46 303.459 333.16 311.245 329.151 318.194C327.915 320.337 326.515 322.4 324.953 324.384C318.549 332.799 308.611 343.127 295.139 355.367L377.297 355.37L406.121 405.289L217.29 405.282L188.467 355.363Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M9.32197 225.972L-13.5365 225.971L-42.5255 175.765L43.2765 175.768L175.798 405.282L112.854 405.279L9.32197 225.972Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M345.247 111.915C329.566 99.2919 312.229 89.5371 293.235 82.6512L235.167 183.228C254.161 190.114 271.498 199.869 287.179 212.492L345.247 111.915Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M382.686 154.964C373.41 138.898 360.931 124.553 345.25 111.93L287.182 212.506C302.863 225.13 315.342 239.475 324.618 255.541L382.686 154.964Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M293.243 82.6472C274.139 75.57 254.869 72.031 235.434 72.0303L177.366 172.607C196.801 172.608 216.071 176.147 235.175 183.224L293.243 82.6472Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M394.118 194.257C395.112 182.973 391.301 169.872 382.688 154.953L324.619 255.53C333.233 270.448 337.044 283.55 336.05 294.834L394.118 194.257Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M235.432 72.0311C216.88 72.0304 202.027 75.5681 190.875 82.6442L132.806 183.221C143.959 176.145 158.812 172.607 177.363 172.608L235.432 72.0311Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M265.59 124.25C276.191 124.251 286.24 127.12 295.737 132.858L237.669 233.435C228.172 227.697 218.123 224.828 207.522 224.827L265.59 124.25Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M295.719 132.859C305.326 138.406 312.78 145.77 318.081 154.95L260.013 255.527C254.712 246.347 247.258 238.983 237.651 233.436L295.719 132.859Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M387.218 217.608C391.227 210.66 393.527 202.874 394.117 194.25L336.049 294.827C335.459 303.451 333.159 311.237 329.15 318.185L387.218 217.608Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M245.211 132.577C248.413 127.03 255.204 124.257 265.584 124.258L207.516 224.835C197.136 224.834 190.345 227.607 187.143 233.154L245.211 132.577Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M318.094 154.945C322.842 163.17 324.002 171.107 321.573 178.757L263.505 279.334C265.934 271.684 264.774 263.746 260.026 255.522L318.094 154.945Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M176.925 96.6737C180.127 91.1249 184.776 86.4503 190.871 82.6499L132.803 183.227C126.708 187.027 122.059 191.702 118.857 197.25L176.925 96.6737Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M387.226 217.606C385.989 219.749 384.59 221.813 383.028 223.797L324.96 324.373C326.522 322.39 327.921 320.326 329.157 318.183L387.226 217.606Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M317.269 188.408C319.087 185.262 320.519 182.045 321.562 178.758L263.494 279.335C262.451 282.622 261.019 285.839 259.201 288.985L317.269 188.408Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M245.208 132.573C241.895 137.928 243 145.387 248.522 154.95L190.454 255.527C184.932 245.964 183.827 238.505 187.14 233.15L245.208 132.573Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M176.93 96.6719C174.331 101.175 172.686 106.255 171.993 111.91L113.925 212.487C114.618 206.831 116.263 201.752 118.862 197.249L176.93 96.6719Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M317.266 188.413C314.853 192.589 311.757 196.64 307.978 200.566L249.91 301.143C253.689 297.216 256.785 293.166 259.198 288.99L317.266 188.413Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M464.198 304.708L435.375 254.789L377.307 355.366L406.13 405.285L464.198 304.708Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M353.209 254.787C366.68 242.548 376.618 232.22 383.023 223.805L324.955 324.382C318.55 332.797 308.612 343.124 295.141 355.364L353.209 254.787Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M435.37 254.787L353.212 254.784L295.144 355.361L377.302 355.364L435.37 254.787Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M183.921 154.947L248.521 154.95L190.453 255.527L125.853 255.524L183.921 154.947Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M171.992 111.914C170.668 124.537 174.643 138.881 183.92 154.947L125.852 255.524C116.575 239.458 112.599 225.114 113.924 212.491L171.992 111.914Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M307.987 200.562C301.251 207.256 291.203 216.244 277.842 227.528L219.774 328.105C233.135 316.821 243.183 307.832 249.919 301.139L307.987 200.562Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M15.5469 75.1797L44.5359 125.386L-13.5321 225.963L-42.5212 175.756L15.5469 75.1797Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M277.836 227.536C264.033 238.82 253.708 247.904 246.862 254.789L188.794 355.366C195.64 348.481 205.965 339.397 219.768 328.113L277.836 227.536Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M275.358 304.706L464.189 304.713L406.12 405.29L217.29 405.283L275.358 304.706Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M44.5279 125.39L67.3864 125.39L9.31834 225.967L-13.5401 225.966L44.5279 125.39Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M101.341 75.1911L233.863 304.705L175.795 405.282L43.2733 175.768L101.341 75.1911ZM15.5431 75.19L-42.525 175.767L43.277 175.77L101.345 75.1932L15.5431 75.19Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M246.866 254.784L246.534 254.784L188.466 355.361L188.798 355.361L246.866 254.784Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M246.539 254.781L275.362 304.701L217.294 405.277L188.471 355.358L246.539 254.781Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M67.3906 125.391L170.923 304.698L112.855 405.275L9.32257 225.967L67.3906 125.391Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                            &lt;path d=&quot;M170.921 304.699L233.865 304.701L175.797 405.278L112.853 405.276L170.921 304.699Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot; /&gt;
                        &lt;/g&gt;
                        &lt;g style=&quot;mix-blend-mode: hard-light&quot; class=&quot;transition-all delay-300 translate-y-0 opacity-100 duration-750 starting:opacity-0 starting:translate-y-4&quot;&gt;
                            &lt;path d=&quot;M246.544 254.79L246.875 254.79C253.722 247.905 264.046 238.82 277.849 227.537C291.21 216.253 301.259 207.264 307.995 200.57C314.62 193.685 319.147 186.418 321.577 178.768C324.006 171.117 322.846 163.18 318.097 154.956C312.796 145.775 305.342 138.412 295.735 132.865C286.238 127.127 276.189 124.258 265.588 124.257C255.208 124.257 248.416 127.03 245.214 132.576C241.902 137.931 243.006 145.39 248.528 154.953L183.928 154.951C174.652 138.885 170.676 124.541 172 111.918C173.546 99.2946 179.84 89.5408 190.882 82.6559C202.035 75.5798 216.887 72.0421 235.439 72.0428C254.874 72.0435 274.144 75.5825 293.248 82.6598C312.242 89.5457 329.579 99.3005 345.261 111.924C360.942 124.548 373.421 138.892 382.697 154.958C391.311 169.877 395.121 182.978 394.128 194.262C393.355 205.546 389.656 215.396 383.031 223.811C376.627 232.226 366.688 242.554 353.217 254.794L435.375 254.797L464.198 304.716L275.367 304.709L246.544 254.79Z&quot; fill=&quot;#F0ACB8&quot; /&gt;
                            &lt;path d=&quot;M246.544 254.79L246.875 254.79C253.722 247.905 264.046 238.82 277.849 227.537C291.21 216.253 301.259 207.264 307.995 200.57C314.62 193.685 319.147 186.418 321.577 178.768C324.006 171.117 322.846 163.18 318.097 154.956C312.796 145.775 305.342 138.412 295.735 132.865C286.238 127.127 276.189 124.258 265.588 124.257C255.208 124.257 248.416 127.03 245.214 132.576C241.902 137.931 243.006 145.39 248.528 154.953L183.928 154.951C174.652 138.885 170.676 124.541 172 111.918C173.546 99.2946 179.84 89.5408 190.882 82.6559C202.035 75.5798 216.887 72.0421 235.439 72.0428C254.874 72.0435 274.144 75.5825 293.248 82.6598C312.242 89.5457 329.579 99.3005 345.261 111.924C360.942 124.548 373.421 138.892 382.697 154.958C391.311 169.877 395.121 182.978 394.128 194.262C393.355 205.546 389.656 215.396 383.031 223.811C376.627 232.226 366.688 242.554 353.217 254.794L435.375 254.797L464.198 304.716L275.367 304.709L246.544 254.79Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;round&quot; /&gt;
                        &lt;/g&gt;
                        &lt;g style=&quot;mix-blend-mode: hard-light&quot; class=&quot;transition-all delay-300 translate-y-0 opacity-100 duration-750 starting:opacity-0 starting:translate-y-4&quot;&gt;
                            &lt;path d=&quot;M67.41 125.402L44.5515 125.401L15.5625 75.1953L101.364 75.1985L233.886 304.712L170.942 304.71L67.41 125.402Z&quot; fill=&quot;#F0ACB8&quot; /&gt;
                            &lt;path d=&quot;M67.41 125.402L44.5515 125.401L15.5625 75.1953L101.364 75.1985L233.886 304.712L170.942 304.71L67.41 125.402Z&quot; stroke=&quot;#1B1B18&quot; stroke-width=&quot;1&quot; /&gt;
                        &lt;/g&gt;
                    &lt;/svg&gt;

                    
                    &lt;svg class=&quot;w-[448px] max-w-none relative -mt-[4.9rem] -ml-8 lg:ml-0 lg:-mt-[6.6rem] hidden dark:block&quot; viewBox=&quot;0 0 440 376&quot; fill=&quot;none&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;&gt;
                        &lt;g class=&quot;transition-all delay-300 translate-y-0 opacity-100 duration-750 starting:opacity-0 starting:translate-y-4&quot;&gt;
                            &lt;path d=&quot;M188.263 355.73L188.595 355.73C195.441 348.845 205.766 339.761 219.569 328.477C232.93 317.193 242.978 308.205 249.714 301.511C256.34 294.626 260.867 287.358 263.296 279.708C265.725 272.058 264.565 264.121 259.816 255.896C254.516 246.716 247.062 239.352 237.454 233.805C227.957 228.067 217.908 225.198 207.307 225.198C196.927 225.197 190.136 227.97 186.934 233.516C183.621 238.872 184.726 246.331 190.247 255.894L125.647 255.891C116.371 239.825 112.395 225.481 113.72 212.858C115.265 200.235 121.559 190.481 132.602 183.596C143.754 176.52 158.607 172.982 177.159 172.983C196.594 172.984 215.863 176.523 234.968 183.6C253.961 190.486 271.299 200.241 286.98 212.864C302.661 225.488 315.14 239.833 324.416 255.899C333.03 270.817 336.841 283.918 335.847 295.203C335.075 306.487 331.376 316.336 324.75 324.751C318.346 333.167 308.408 343.494 294.936 355.734L377.094 355.737L405.917 405.656L217.087 405.649L188.263 355.73Z&quot; fill=&quot;black&quot;/&gt;
                            &lt;path d=&quot;M9.11884 226.339L-13.7396 226.338L-42.7286 176.132L43.0733 176.135L175.595 405.649L112.651 405.647L9.11884 226.339Z&quot; fill=&quot;black&quot;/&gt;
                            &lt;path d=&quot;M188.263 355.73L188.595 355.73C195.441 348.845 205.766 339.761 219.569 328.477C232.93 317.193 242.978 308.205 249.714 301.511C256.34 294.626 260.867 287.358 263.296 279.708C265.725 272.058 264.565 264.121 259.816 255.896C254.516 246.716 247.062 239.352 237.454 233.805C227.957 228.067 217.908 225.198 207.307 225.198C196.927 225.197 190.136 227.97 186.934 233.516C183.621 238.872 184.726 246.331 190.247 255.894L125.647 255.891C116.371 239.825 112.395 225.481 113.72 212.858C115.265 200.235 121.559 190.481 132.602 183.596C143.754 176.52 158.607 172.982 177.159 172.983C196.594 172.984 215.863 176.523 234.968 183.6C253.961 190.486 271.299 200.241 286.98 212.864C302.661 225.488 315.14 239.833 324.416 255.899C333.03 270.817 336.841 283.918 335.847 295.203C335.075 306.487 331.376 316.336 324.75 324.751C318.346 333.167 308.408 343.494 294.936 355.734L377.094 355.737L405.917 405.656L217.087 405.649L188.263 355.73Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot;/&gt;
                            &lt;path d=&quot;M9.11884 226.339L-13.7396 226.338L-42.7286 176.132L43.0733 176.135L175.595 405.649L112.651 405.647L9.11884 226.339Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot;/&gt;
                            &lt;path d=&quot;M204.592 327.449L204.923 327.449C211.769 320.564 222.094 311.479 235.897 300.196C249.258 288.912 259.306 279.923 266.042 273.23C272.668 266.345 277.195 259.077 279.624 251.427C282.053 243.777 280.893 235.839 276.145 227.615C270.844 218.435 263.39 211.071 253.782 205.524C244.285 199.786 234.236 196.917 223.635 196.916C213.255 196.916 206.464 199.689 203.262 205.235C199.949 210.59 201.054 218.049 206.575 227.612L141.975 227.61C132.699 211.544 128.723 197.2 130.048 184.577C131.593 171.954 137.887 162.2 148.93 155.315C160.083 148.239 174.935 144.701 193.487 144.702C212.922 144.703 232.192 148.242 251.296 155.319C270.289 162.205 287.627 171.96 303.308 184.583C318.989 197.207 331.468 211.552 340.745 227.618C349.358 242.536 353.169 255.637 352.175 266.921C351.403 278.205 347.704 288.055 341.078 296.47C334.674 304.885 324.736 315.213 311.264 327.453L393.422 327.456L422.246 377.375L233.415 377.368L204.592 327.449Z&quot; fill=&quot;#391800&quot;/&gt;
                            &lt;path d=&quot;M25.447 198.058L2.58852 198.057L-26.4005 147.851L59.4015 147.854L191.923 377.368L128.979 377.365L25.447 198.058Z&quot; fill=&quot;#391800&quot;/&gt;
                            &lt;path d=&quot;M204.592 327.449L204.923 327.449C211.769 320.564 222.094 311.479 235.897 300.196C249.258 288.912 259.306 279.923 266.042 273.23C272.668 266.345 277.195 259.077 279.624 251.427C282.053 243.777 280.893 235.839 276.145 227.615C270.844 218.435 263.39 211.071 253.782 205.524C244.285 199.786 234.236 196.917 223.635 196.916C213.255 196.916 206.464 199.689 203.262 205.235C199.949 210.59 201.054 218.049 206.575 227.612L141.975 227.61C132.699 211.544 128.723 197.2 130.048 184.577C131.593 171.954 137.887 162.2 148.93 155.315C160.083 148.239 174.935 144.701 193.487 144.702C212.922 144.703 232.192 148.242 251.296 155.319C270.289 162.205 287.627 171.96 303.308 184.583C318.989 197.207 331.468 211.552 340.745 227.618C349.358 242.536 353.169 255.637 352.175 266.921C351.403 278.205 347.704 288.055 341.078 296.47C334.674 304.885 324.736 315.213 311.264 327.453L393.422 327.456L422.246 377.375L233.415 377.368L204.592 327.449Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot;/&gt;
                            &lt;path d=&quot;M25.447 198.058L2.58852 198.057L-26.4005 147.851L59.4015 147.854L191.923 377.368L128.979 377.365L25.447 198.058Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot;/&gt;
                        &lt;/g&gt;
                        &lt;g class=&quot;transition-all delay-300 translate-y-0 opacity-100 duration-750 starting:opacity-0 starting:translate-y-4&quot; style=&quot;mix-blend-mode:hard-light&quot;&gt;
                            &lt;path d=&quot;M217.342 305.363L217.673 305.363C224.519 298.478 234.844 289.393 248.647 278.11C262.008 266.826 272.056 257.837 278.792 251.144C285.418 244.259 289.945 236.991 292.374 229.341C294.803 221.691 293.643 213.753 288.895 205.529C283.594 196.349 276.14 188.985 266.532 183.438C257.035 177.7 246.986 174.831 236.385 174.83C226.005 174.83 219.214 177.603 216.012 183.149C212.699 188.504 213.804 195.963 219.325 205.527L154.725 205.524C145.449 189.458 141.473 175.114 142.798 162.491C144.343 149.868 150.637 140.114 161.68 133.229C172.833 126.153 187.685 122.615 206.237 122.616C225.672 122.617 244.942 126.156 264.046 133.233C283.039 140.119 300.377 149.874 316.058 162.497C331.739 175.121 344.218 189.466 353.495 205.532C362.108 220.45 365.919 233.551 364.925 244.835C364.153 256.12 360.454 265.969 353.828 274.384C347.424 282.799 337.486 293.127 324.014 305.367L406.172 305.37L434.996 355.289L246.165 355.282L217.342 305.363Z&quot; fill=&quot;#733000&quot;/&gt;
                            &lt;path d=&quot;M38.197 175.972L15.3385 175.971L-13.6505 125.765L72.1515 125.768L204.673 355.282L141.729 355.279L38.197 175.972Z&quot; fill=&quot;#733000&quot;/&gt;
                            &lt;path d=&quot;M217.342 305.363L217.673 305.363C224.519 298.478 234.844 289.393 248.647 278.11C262.008 266.826 272.056 257.837 278.792 251.144C285.418 244.259 289.945 236.991 292.374 229.341C294.803 221.691 293.643 213.753 288.895 205.529C283.594 196.349 276.14 188.985 266.532 183.438C257.035 177.7 246.986 174.831 236.385 174.83C226.005 174.83 219.214 177.603 216.012 183.149C212.699 188.504 213.804 195.963 219.325 205.527L154.725 205.524C145.449 189.458 141.473 175.114 142.798 162.491C144.343 149.868 150.637 140.114 161.68 133.229C172.833 126.153 187.685 122.615 206.237 122.616C225.672 122.617 244.942 126.156 264.046 133.233C283.039 140.119 300.377 149.874 316.058 162.497C331.739 175.121 344.218 189.466 353.495 205.532C362.108 220.45 365.919 233.551 364.925 244.835C364.153 256.12 360.454 265.969 353.828 274.384C347.424 282.799 337.486 293.127 324.014 305.367L406.172 305.37L434.996 355.289L246.165 355.282L217.342 305.363Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot;/&gt;
                            &lt;path d=&quot;M38.197 175.972L15.3385 175.971L-13.6505 125.765L72.1515 125.768L204.673 355.282L141.729 355.279L38.197 175.972Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot;/&gt;
                        &lt;/g&gt;
                        &lt;g class=&quot;transition-all delay-300 translate-y-0 opacity-100 duration-750 starting:opacity-0 starting:translate-y-4&quot;&gt;
                            &lt;path d=&quot;M217.342 305.363L217.673 305.363C224.519 298.478 234.844 289.393 248.647 278.11C262.008 266.826 272.056 257.837 278.792 251.144C285.418 244.259 289.945 236.991 292.374 229.341C294.803 221.691 293.643 213.753 288.895 205.529C283.594 196.349 276.14 188.985 266.532 183.438C257.035 177.7 246.986 174.831 236.385 174.83C226.005 174.83 219.214 177.603 216.012 183.149C212.699 188.504 213.804 195.963 219.325 205.527L154.726 205.524C145.449 189.458 141.473 175.114 142.798 162.491C144.343 149.868 150.637 140.114 161.68 133.229C172.833 126.153 187.685 122.615 206.237 122.616C225.672 122.617 244.942 126.156 264.046 133.233C283.039 140.119 300.377 149.874 316.058 162.497C331.739 175.121 344.218 189.466 353.495 205.532C362.108 220.45 365.919 233.551 364.925 244.835C364.153 256.12 360.454 265.969 353.828 274.384C347.424 282.799 337.486 293.127 324.014 305.367L406.172 305.37L434.996 355.289L246.165 355.282L217.342 305.363Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot;/&gt;
                            &lt;path d=&quot;M38.197 175.972L15.3385 175.971L-13.6505 125.765L72.1515 125.768L204.673 355.282L141.729 355.279L38.197 175.972Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot;/&gt;
                        &lt;/g&gt;
                        &lt;g class=&quot;transition-all delay-300 translate-y-0 opacity-100 duration-750 starting:opacity-0 starting:translate-y-4&quot;&gt;
                            &lt;path d=&quot;M188.467 355.363L188.798 355.363C195.644 348.478 205.969 339.393 219.772 328.11C233.133 316.826 243.181 307.837 249.917 301.144C253.696 297.217 256.792 293.166 259.205 288.991C261.024 285.845 262.455 282.628 263.499 279.341C265.928 271.691 264.768 263.753 260.02 255.529C254.719 246.349 247.265 238.985 237.657 233.438C228.16 227.7 218.111 224.831 207.51 224.83C197.13 224.83 190.339 227.603 187.137 233.149C183.824 238.504 184.929 245.963 190.45 255.527L125.851 255.524C116.574 239.458 112.598 225.114 113.923 212.491C114.615 206.836 116.261 201.756 118.859 197.253C122.061 191.704 126.709 187.03 132.805 183.229C143.958 176.153 158.81 172.615 177.362 172.616C196.797 172.617 216.067 176.156 235.171 183.233C254.164 190.119 271.502 199.874 287.183 212.497C302.864 225.121 315.343 239.466 324.62 255.532C333.233 270.45 337.044 283.551 336.05 294.835C335.46 303.459 333.16 311.245 329.151 318.194C327.915 320.337 326.515 322.4 324.953 324.384C318.549 332.799 308.611 343.127 295.139 355.367L377.297 355.37L406.121 405.289L217.29 405.282L188.467 355.363Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M9.32197 225.972L-13.5365 225.971L-42.5255 175.765L43.2765 175.768L175.798 405.282L112.854 405.279L9.32197 225.972Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M345.247 111.915C329.566 99.2919 312.229 89.5371 293.235 82.6512L235.167 183.228C254.161 190.114 271.498 199.869 287.179 212.492L345.247 111.915Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M382.686 154.964C373.41 138.898 360.931 124.553 345.25 111.93L287.182 212.506C302.863 225.13 315.342 239.475 324.618 255.541L382.686 154.964Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M293.243 82.6472C274.139 75.57 254.869 72.031 235.434 72.0303L177.366 172.607C196.801 172.608 216.071 176.147 235.175 183.224L293.243 82.6472Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M394.118 194.257C395.112 182.973 391.301 169.872 382.688 154.953L324.619 255.53C333.233 270.448 337.044 283.55 336.05 294.834L394.118 194.257Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M235.432 72.0311C216.88 72.0304 202.027 75.5681 190.875 82.6442L132.806 183.221C143.959 176.145 158.812 172.607 177.363 172.608L235.432 72.0311Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M265.59 124.25C276.191 124.251 286.24 127.12 295.737 132.858L237.669 233.435C228.172 227.697 218.123 224.828 207.522 224.827L265.59 124.25Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M295.719 132.859C305.326 138.406 312.78 145.77 318.081 154.95L260.013 255.527C254.712 246.347 247.258 238.983 237.651 233.436L295.719 132.859Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M387.218 217.608C391.227 210.66 393.527 202.874 394.117 194.25L336.049 294.827C335.459 303.451 333.159 311.237 329.15 318.185L387.218 217.608Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M245.211 132.577C248.413 127.03 255.204 124.257 265.584 124.258L207.516 224.835C197.136 224.834 190.345 227.607 187.143 233.154L245.211 132.577Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M318.094 154.945C322.842 163.17 324.002 171.107 321.573 178.757L263.505 279.334C265.934 271.684 264.774 263.746 260.026 255.522L318.094 154.945Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M176.925 96.6737C180.127 91.1249 184.776 86.4503 190.871 82.6499L132.803 183.227C126.708 187.027 122.059 191.702 118.857 197.25L176.925 96.6737Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M387.226 217.606C385.989 219.749 384.59 221.813 383.028 223.797L324.96 324.373C326.522 322.39 327.921 320.326 329.157 318.183L387.226 217.606Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M317.269 188.408C319.087 185.262 320.519 182.045 321.562 178.758L263.494 279.335C262.451 282.622 261.019 285.839 259.201 288.985L317.269 188.408Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M245.208 132.573C241.895 137.928 243 145.387 248.522 154.95L190.454 255.527C184.932 245.964 183.827 238.505 187.14 233.15L245.208 132.573Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M176.93 96.6719C174.331 101.175 172.686 106.255 171.993 111.91L113.925 212.487C114.618 206.831 116.263 201.752 118.862 197.249L176.93 96.6719Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M317.266 188.413C314.853 192.589 311.757 196.64 307.978 200.566L249.91 301.143C253.689 297.216 256.785 293.166 259.198 288.99L317.266 188.413Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M464.198 304.708L435.375 254.789L377.307 355.366L406.13 405.285L464.198 304.708Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M353.209 254.787C366.68 242.548 376.618 232.22 383.023 223.805L324.955 324.382C318.55 332.797 308.612 343.124 295.141 355.364L353.209 254.787Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M435.37 254.787L353.212 254.784L295.144 355.361L377.302 355.364L435.37 254.787Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M183.921 154.947L248.521 154.95L190.453 255.527L125.853 255.524L183.921 154.947Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M171.992 111.914C170.668 124.537 174.643 138.881 183.92 154.947L125.852 255.524C116.575 239.458 112.599 225.114 113.924 212.491L171.992 111.914Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M307.987 200.562C301.251 207.256 291.203 216.244 277.842 227.528L219.774 328.105C233.135 316.821 243.183 307.832 249.919 301.139L307.987 200.562Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M15.5469 75.1797L44.5359 125.386L-13.5321 225.963L-42.5212 175.756L15.5469 75.1797Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M277.836 227.536C264.033 238.82 253.708 247.904 246.862 254.789L188.794 355.366C195.64 348.481 205.965 339.397 219.768 328.113L277.836 227.536Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M275.358 304.706L464.189 304.713L406.12 405.29L217.29 405.283L275.358 304.706Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M44.5279 125.39L67.3864 125.39L9.31834 225.967L-13.5401 225.966L44.5279 125.39Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M101.341 75.1911L233.863 304.705L175.795 405.282L43.2733 175.768L101.341 75.1911ZM15.5431 75.19L-42.525 175.767L43.277 175.77L101.345 75.1932L15.5431 75.19Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M246.866 254.784L246.534 254.784L188.466 355.361L188.798 355.361L246.866 254.784Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M246.539 254.781L275.362 304.701L217.294 405.277L188.471 355.358L246.539 254.781Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M67.3906 125.391L170.923 304.698L112.855 405.275L9.32257 225.967L67.3906 125.391Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                            &lt;path d=&quot;M170.921 304.699L233.865 304.701L175.797 405.278L112.853 405.276L170.921 304.699Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;bevel&quot;/&gt;
                        &lt;/g&gt;
                        &lt;g class=&quot;transition-all delay-300 translate-y-0 opacity-100 duration-750 starting:opacity-0 starting:translate-y-4&quot; style=&quot;mix-blend-mode:hard-light&quot;&gt;
                            &lt;path d=&quot;M246.544 254.79L246.875 254.79C253.722 247.905 264.046 238.82 277.849 227.537C291.21 216.253 301.259 207.264 307.995 200.57C314.62 193.685 319.147 186.418 321.577 178.768C324.006 171.117 322.846 163.18 318.097 154.956C312.796 145.775 305.342 138.412 295.735 132.865C286.238 127.127 276.189 124.258 265.588 124.257C255.208 124.257 248.416 127.03 245.214 132.576C241.902 137.931 243.006 145.39 248.528 154.953L183.928 154.951C174.652 138.885 170.676 124.541 172 111.918C173.546 99.2946 179.84 89.5408 190.882 82.6559C202.035 75.5798 216.887 72.0421 235.439 72.0428C254.874 72.0435 274.144 75.5825 293.248 82.6598C312.242 89.5457 329.579 99.3005 345.261 111.924C360.942 124.548 373.421 138.892 382.697 154.958C391.311 169.877 395.121 182.978 394.128 194.262C393.355 205.546 389.656 215.396 383.031 223.811C376.627 232.226 366.688 242.554 353.217 254.794L435.375 254.797L464.198 304.716L275.367 304.709L246.544 254.79Z&quot; fill=&quot;#4B0600&quot;/&gt;
                            &lt;path d=&quot;M246.544 254.79L246.875 254.79C253.722 247.905 264.046 238.82 277.849 227.537C291.21 216.253 301.259 207.264 307.995 200.57C314.62 193.685 319.147 186.418 321.577 178.768C324.006 171.117 322.846 163.18 318.097 154.956C312.796 145.775 305.342 138.412 295.735 132.865C286.238 127.127 276.189 124.258 265.588 124.257C255.208 124.257 248.416 127.03 245.214 132.576C241.902 137.931 243.006 145.39 248.528 154.953L183.928 154.951C174.652 138.885 170.676 124.541 172 111.918C173.546 99.2946 179.84 89.5408 190.882 82.6559C202.035 75.5798 216.887 72.0421 235.439 72.0428C254.874 72.0435 274.144 75.5825 293.248 82.6598C312.242 89.5457 329.579 99.3005 345.261 111.924C360.942 124.548 373.421 138.892 382.697 154.958C391.311 169.877 395.121 182.978 394.128 194.262C393.355 205.546 389.656 215.396 383.031 223.811C376.627 232.226 366.688 242.554 353.217 254.794L435.375 254.797L464.198 304.716L275.367 304.709L246.544 254.79Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot; stroke-linejoin=&quot;round&quot;/&gt;
                        &lt;/g&gt;
                        &lt;g class=&quot;transition-all delay-300 translate-y-0 opacity-100 duration-750 starting:opacity-0 starting:translate-y-4&quot; style=&quot;mix-blend-mode:hard-light&quot;&gt;
                            &lt;path d=&quot;M67.41 125.402L44.5515 125.401L15.5625 75.1953L101.364 75.1985L233.886 304.712L170.942 304.71L67.41 125.402Z&quot; fill=&quot;#4B0600&quot;/&gt;
                            &lt;path d=&quot;M67.41 125.402L44.5515 125.401L15.5625 75.1953L101.364 75.1985L233.886 304.712L170.942 304.71L67.41 125.402Z&quot; stroke=&quot;#FF750F&quot; stroke-width=&quot;1&quot;/&gt;
                        &lt;/g&gt;
                    &lt;/svg&gt;
                    &lt;div class=&quot;absolute inset-0 rounded-t-lg lg:rounded-t-none lg:rounded-r-lg shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]&quot;&gt;&lt;/div&gt;
                &lt;/div&gt;
            &lt;/main&gt;
        &lt;/div&gt;

                    &lt;div class=&quot;h-14.5 hidden lg:block&quot;&gt;&lt;/div&gt;
            &lt;/body&gt;
&lt;/html&gt;
</code>
 </pre>
    </span>
<span id="execution-results-GET-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GET-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GET-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GET-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GET-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GET-" data-method="GET"
      data-path="/"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GET-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GET-"
                    onclick="tryItOut('GET-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GET-"
                    onclick="cancelTryOut('GET-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GET-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>/</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GET-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GET-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETlogin">Show the application&#039;s login form.</h2>

<p>
</p>



<span id="example-requests-GETlogin">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETlogin">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6IjY0RjJsUkVnbzRYU3Z1SitvZnA3U1E9PSIsInZhbHVlIjoialNQdUVCeGRBbTB6M09kWlZoTTM3L1dSaHUyZ3hLaExPcWRORDd6ejA5cGduOExBZkYvbzJvUjB2ejNtc2hIVUdnaWQxSWpQUm54eXdUcHNabzVZZXNGczk2ZU9NRjVkMFNqbnQvUGRGdXdPam5MY295UDhFNnNzdHBiV0NvejciLCJtYWMiOiIzZjk4MmY3MTY1ODY2NWY4ZTMzNjRjYzFhNzkwZGE5ZTFjOTBkOTEwODYwY2Y3YzQ2MWRmZGViNzAzZDgyYTYwIiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; samesite=lax; wsgmed_session=eyJpdiI6ImRiRkU2WUlxai9kZEl0Z2ZnTElVUlE9PSIsInZhbHVlIjoid05aQmRtbjYwakJCblJHMVZTbUJsbEhycHVINWRadHBlSTMyQXlKWSt5U0pzM3E5bHgwbGpoU2oxL0NBMUF1OUF6UWprMnhydGFReDA2U1RvWTNLUlhQZEdNRjAyMFBqWVVFSGFScDk2cmh2S2J1Qlg2ZUpPWlpUK3Y4eW92WXkiLCJtYWMiOiI0ZmYxZDRkMmZhZjRhOTI3N2EzMDczYzk5ODZkYzc2NGI4MDFmMzE5MWFjMmZkNmQ3MWUzYWQ1ODcxZGE3NzAxIiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETlogin" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETlogin"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETlogin"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETlogin" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETlogin">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETlogin" data-method="GET"
      data-path="login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETlogin', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETlogin"
                    onclick="tryItOut('GETlogin');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETlogin"
                    onclick="cancelTryOut('GETlogin');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETlogin"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETlogin"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETlogin"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTlogin">Handle a login request to the application.</h2>

<p>
</p>



<span id="example-requests-POSTlogin">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTlogin">
</span>
<span id="execution-results-POSTlogin" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTlogin"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTlogin"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTlogin" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTlogin">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTlogin" data-method="POST"
      data-path="login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTlogin', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTlogin"
                    onclick="tryItOut('POSTlogin');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTlogin"
                    onclick="cancelTryOut('POSTlogin');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTlogin"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTlogin"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTlogin"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTlogout">Log the user out of the application.</h2>

<p>
</p>



<span id="example-requests-POSTlogout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/logout" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/logout"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTlogout">
</span>
<span id="execution-results-POSTlogout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTlogout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTlogout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTlogout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTlogout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTlogout" data-method="POST"
      data-path="logout"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTlogout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTlogout"
                    onclick="tryItOut('POSTlogout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTlogout"
                    onclick="cancelTryOut('POSTlogout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTlogout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTlogout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTlogout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETregister">Show the application registration form.</h2>

<p>
</p>



<span id="example-requests-GETregister">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETregister">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6IkFwZnpWQ2NGSEZ0S3h5WitXUUowd1E9PSIsInZhbHVlIjoicWg0aEQ1cVRPTzRhL09ma0xRYzlJTnpPWHQrdXhQbXBtRmxGaDNzRWNkQ1ptVGNEdFBrd0NGL3NuQTJzb1RsWXIyT2QzQWxnMTRVTk9zcWhhdlp0MkpGUEFCUGkreXhjelNCWS8xSDdVNkRWVDdndlFkZzdpUDJqVzhEcXlsTkEiLCJtYWMiOiI1ODczZjUxZDJkOTAyNTM4NDg0YWU2ZTg5YjdhMGUzMGQxOTU5NDk1NmEzNzcyYTcwODNlODBlNWE0Zjc5OWYyIiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; samesite=lax; wsgmed_session=eyJpdiI6IlVpbHdwTzM3OTJSSWtjMGpEa2F2aVE9PSIsInZhbHVlIjoiSzhuZ1JEZ0tLb2svdTg3WlpXOThnMW52NzVBNmZBL3pka0ZYV1k4V0ZvQ1JnVW0yOXA3MDQvdGl3NDNGbnRDakl6WmNTRmpZZElGSCsxcmVPSUlHd1NPcUE1cmc1QUJsdWxmdnhoaElXWitRby9vMHZWaml1MzhSZUF3OXR2K1UiLCJtYWMiOiI5ODcwOGUxYzAxMWVmOWYyY2VjYjJkMGQ2ODdjMjY1NTgwYTk1MWMyYzBmNTBjY2ViMjUyNDM2NTY4ZWM0NzAyIiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETregister" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETregister"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETregister"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETregister" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETregister">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETregister" data-method="GET"
      data-path="register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETregister', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETregister"
                    onclick="tryItOut('GETregister');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETregister"
                    onclick="cancelTryOut('GETregister');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETregister"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETregister"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETregister"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTregister">Handle a registration request for the application.</h2>

<p>
</p>



<span id="example-requests-POSTregister">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTregister">
</span>
<span id="execution-results-POSTregister" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTregister"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTregister"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTregister" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTregister">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTregister" data-method="POST"
      data-path="register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTregister', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTregister"
                    onclick="tryItOut('POSTregister');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTregister"
                    onclick="cancelTryOut('POSTregister');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTregister"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTregister"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTregister"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETpassword-reset">Display the form to request a password reset link.</h2>

<p>
</p>



<span id="example-requests-GETpassword-reset">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/password/reset" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/password/reset"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETpassword-reset">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6Imo1a1BBd0VzT3U5SUt4ZjZkTHd0VHc9PSIsInZhbHVlIjoiNkVCWXNYNlhJOWFZYmczTFlCMDBEck5xZEhjY1BtdDQ1dWZLc3NKUFJGSWJ6T2FGczNjcEM4NDZuWmd3amExaHg2eU1FVDhGSmlNa0N2Y050VUtIT0hlcTVYTStJQzQvMWs4SFVlMml3NExHcXpYSkE3NzNrZHdsSkJEaktTR2oiLCJtYWMiOiIwZDA2OTU5ZTE0ZGE5MGQwMmUwNTY0MDU4MTc4MGQyODNjODdjNTE5ODU2ZjM1NzU1OTg1YWE0Yjg3M2RmNzUzIiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; samesite=lax; wsgmed_session=eyJpdiI6InMxN083NHVrankraVM1ZHVkZDJJWmc9PSIsInZhbHVlIjoidFNPZWhPaGpuYXlqVXFNY1lGbWViQ3d6aHduUFdXNTZrVDNFRUdLVU9mUGRUR3FxbHR0U0hTSTdtUVpKSGNBNmpDbUtZeWZiRXN2Wm5SZWE0Qis1V0pDZzF6cFljNGtyK1ErS202ZUY2M2k5Q3VmYmJvdXFrT2xwclZPcVNWVjAiLCJtYWMiOiJhOWUyYjEyZDg4NDU4NTk4ZTU1MGU4YzBmNjAwY2RlZjYxNzE4ZTVhY2VjYmNhZThjMDcwZTA4NjM0Y2U0ZjU1IiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETpassword-reset" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETpassword-reset"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETpassword-reset"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETpassword-reset" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETpassword-reset">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETpassword-reset" data-method="GET"
      data-path="password/reset"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETpassword-reset', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETpassword-reset"
                    onclick="tryItOut('GETpassword-reset');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETpassword-reset"
                    onclick="cancelTryOut('GETpassword-reset');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETpassword-reset"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>password/reset</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETpassword-reset"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETpassword-reset"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTpassword-email">Send a reset link to the given user.</h2>

<p>
</p>



<span id="example-requests-POSTpassword-email">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/password/email" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/password/email"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTpassword-email">
</span>
<span id="execution-results-POSTpassword-email" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTpassword-email"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTpassword-email"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTpassword-email" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTpassword-email">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTpassword-email" data-method="POST"
      data-path="password/email"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTpassword-email', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTpassword-email"
                    onclick="tryItOut('POSTpassword-email');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTpassword-email"
                    onclick="cancelTryOut('POSTpassword-email');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTpassword-email"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>password/email</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTpassword-email"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTpassword-email"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETpassword-reset--token-">Display the password reset view for the given token.</h2>

<p>
</p>

<p>If no token is present, display the link request form.</p>

<span id="example-requests-GETpassword-reset--token-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/password/reset/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/password/reset/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETpassword-reset--token-">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6ImhsK2xlQktlajZGUGY5SDN5SHlpN3c9PSIsInZhbHVlIjoibW1ESDk4THhzVk5hWGpaNXZKdkU0eFNPK0ROYjZRZkhoMW5MWVcrWFY3YzhFaFdnanpURHY1alYzTCtFWnk3eTNRNjFkQWN2ZVYzRXkrVC9QdkJROEVNVGw5Mi83bGo3ajhya0pwZlpxbFZ4SzBCZ3JvOEJya0ZqMWtLNE5LbEUiLCJtYWMiOiJiMjQwYWRlNjQxOTMxMzQyMTQxZDZjYzdiY2I0MjllMGZmY2Y0NzBhMTRjMmU1MTkzYjU3YzcxZjY2NzFhN2VjIiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; samesite=lax; wsgmed_session=eyJpdiI6InFDWXNuYjFESVZKUHVCaEthQjlTTUE9PSIsInZhbHVlIjoiTUdvSmErK0J2R3pOZmlvUW1JZDlJa3F1VEtEL1RseTJCRlNia1duMy9rajN4SW9Rc0c3c3FJVGNUa3plL0hoOTZ3dUpMTVZyc3ZralhCV3dlWlJlb2x5UkV4N2JueVdPenZEeWVSK0x6eTZSZjRQYWdDQUFwOWJIdVp6UVFreWwiLCJtYWMiOiI2ZDg0YTNlNzUzOWQxNTE1NjcyZDVjNGQ4MDFmYmYxYjFkYzQ3MjkwOGU3YWE1MzJkNmE1NTZlMGQ5NWQ1YzgxIiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETpassword-reset--token-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETpassword-reset--token-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETpassword-reset--token-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETpassword-reset--token-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETpassword-reset--token-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETpassword-reset--token-" data-method="GET"
      data-path="password/reset/{token}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETpassword-reset--token-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETpassword-reset--token-"
                    onclick="tryItOut('GETpassword-reset--token-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETpassword-reset--token-"
                    onclick="cancelTryOut('GETpassword-reset--token-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETpassword-reset--token-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>password/reset/{token}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETpassword-reset--token-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETpassword-reset--token-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>token</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="token"                data-endpoint="GETpassword-reset--token-"
               value="consequatur"
               data-component="url">
    <br>
<p>Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTpassword-reset">Reset the given user&#039;s password.</h2>

<p>
</p>



<span id="example-requests-POSTpassword-reset">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/password/reset" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/password/reset"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTpassword-reset">
</span>
<span id="execution-results-POSTpassword-reset" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTpassword-reset"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTpassword-reset"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTpassword-reset" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTpassword-reset">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTpassword-reset" data-method="POST"
      data-path="password/reset"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTpassword-reset', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTpassword-reset"
                    onclick="tryItOut('POSTpassword-reset');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTpassword-reset"
                    onclick="cancelTryOut('POSTpassword-reset');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTpassword-reset"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>password/reset</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTpassword-reset"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTpassword-reset"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETpassword-confirm">Display the password confirmation view.</h2>

<p>
</p>



<span id="example-requests-GETpassword-confirm">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/password/confirm" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/password/confirm"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETpassword-confirm">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6ImFYdkNteU1QcUUycHFtblJScDIxdFE9PSIsInZhbHVlIjoiSTVBSnIwbU9rcmpNay9YNkxEWEk0WVRoa3M0OXY1Zm00akNkaHMzVlVmQkU3aFp1WHlOYzNvdHRyN1RlMzl6NURocFlMU2lBRTFjcER4MkdxcmpPRVJ4S0psZnNDZDNoRUpVMll4ODdtaHA1Y3JoWE9MaStXR2t0QVhIT3N3bmoiLCJtYWMiOiIyMDIzYzE3MTdjOWQyNmVmMzEwMGJiOTBlNTAxM2M2MGJkMGEzZjA0ODI0YmI5MmIxMjQzZDFiMDNlM2QzMGE4IiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; samesite=lax; wsgmed_session=eyJpdiI6ImdEVTFleElmUS9YL1o4ZHJ4TWpua2c9PSIsInZhbHVlIjoibzlUZ216Z1FHSm1nTnM1V2FaUTh6M1Vvd05qbllKa0EvT3Z1RVRvU2MwZ3Q2cmg2b3owVzJLbTZnYkpOMVA1T3ZVTjlyK1BSNXJ5OU9ISHR0QWNsN2tlNjVSY3pGb2gzRFQxRG9vbmI4di9iOE9ZNk5LVjVxZkJ1SkFKRkEzTHIiLCJtYWMiOiJmNjEwZGIzM2M4OTVlZWI4NTA5YjM4YjBkYjU0ZDVlZDZhNTZkNzQ0Y2RiMzIxOWYxMGIwNzE5N2Y0YTJhMjFjIiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETpassword-confirm" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETpassword-confirm"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETpassword-confirm"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETpassword-confirm" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETpassword-confirm">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETpassword-confirm" data-method="GET"
      data-path="password/confirm"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETpassword-confirm', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETpassword-confirm"
                    onclick="tryItOut('GETpassword-confirm');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETpassword-confirm"
                    onclick="cancelTryOut('GETpassword-confirm');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETpassword-confirm"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>password/confirm</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETpassword-confirm"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETpassword-confirm"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTpassword-confirm">Confirm the given user&#039;s password.</h2>

<p>
</p>



<span id="example-requests-POSTpassword-confirm">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/password/confirm" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/password/confirm"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTpassword-confirm">
</span>
<span id="execution-results-POSTpassword-confirm" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTpassword-confirm"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTpassword-confirm"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTpassword-confirm" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTpassword-confirm">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTpassword-confirm" data-method="POST"
      data-path="password/confirm"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTpassword-confirm', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTpassword-confirm"
                    onclick="tryItOut('POSTpassword-confirm');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTpassword-confirm"
                    onclick="cancelTryOut('POSTpassword-confirm');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTpassword-confirm"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>password/confirm</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTpassword-confirm"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTpassword-confirm"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GEThome">Show the application dashboard.</h2>

<p>
</p>



<span id="example-requests-GEThome">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/home" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/home"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GEThome">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6InZvWUxFczJja3VqNXBTS3p0b29QRnc9PSIsInZhbHVlIjoiTEhVMFFORkJReVZsTko5ZjQ0UnBXWlRnQXJPWVJQdVJ4M3lpZTJLSUhaWlJKZktIb3FhOHFwR3F0WG9DazZTL0ZHTWxsM3JhVGhWZDhaQ1JTaUQzLzNrV3BWQ3ZSRGhJTGd2NUlZRDFCdi82bmlrY0VVTjNYd1g0V3ZTRnk2KzkiLCJtYWMiOiI4ZTEwMjEwY2MxNDNhNjMwYjI4MDI4ODk0YjYyZDVlZGE1YzM3YWQ0YWE1NDdmM2FkYjk3ZmQ2ZDZhODI1N2IzIiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; samesite=lax; wsgmed_session=eyJpdiI6IjdSM1phQjRlTGE5Y1VDeExKUCtjZlE9PSIsInZhbHVlIjoiYUQvNitCa3p6UmE3UDhETlM3RWFzWTU2dU9OYVp1ZnJLOW1RTEVYVlJHK1crWkQxNnVNenlTcXlhVXozc1JGUitXSGdMMHNKeHVDTTBSWmpXUEZhNTV3TmloRFk3NVluejNmclBxWG1CNzFNQ1FLUFU5dW1icXB0QzZMVUYwMlQiLCJtYWMiOiIyZGRmYTE0ZWQyZDE2OTRiMzA0NWM0NzVjNjZmODg1YTkwMzEzMDkyOGE0MzY4OWQ3M2ExOTc0YTNhMWYyNWI2IiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GEThome" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GEThome"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GEThome"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GEThome" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GEThome">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GEThome" data-method="GET"
      data-path="home"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GEThome', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GEThome"
                    onclick="tryItOut('GEThome');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GEThome"
                    onclick="cancelTryOut('GEThome');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GEThome"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>home</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GEThome"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GEThome"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETpatients">Display a listing of the resource.</h2>

<p>
</p>



<span id="example-requests-GETpatients">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/patients" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patients"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETpatients">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6IjBuSVhKVjNGSW5qSzMwdTU3enBKUHc9PSIsInZhbHVlIjoicGlDU0d6dUZsbTRxN1NlTng2c3pxaXhjMGVLN0hiOHVOdFVZZVlyYU9WNXJyTHYyOXllV1JOeU56OVpmWEsyVnA4ZVEwNUlwa0tQMUNiQy9ScHJ5QzNDdEIyVDY0bVg4TDZkSnJBR2l5N01UUU1Lai9FTEJFSk9HbGF6eDdReVEiLCJtYWMiOiJjZThjMGIxOGU2YzkzYTM4NmQxNGVlODI4YjY3NDM0ZDNhZGE0MWFmYzA0NjcwZDY5MjFkNjliMjIzNWNmNjAxIiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; samesite=lax; wsgmed_session=eyJpdiI6Ilp1QUlMSHRxbDFQb0VZMmVwVGxuTWc9PSIsInZhbHVlIjoiUnVIWW1jZjRNOEZVWmhwMWlVMzdGb0V5dHNjZ2w5QUVKMmpVYSt0RjM3T3U2R3pMRlF6V0l0QkQ1OXliNHU5Y3ZhRCtDelVjWmpYbkUzcjVKSEtOMWE2VmI5M2NjRERPeklYYlFIQTlwUlMzejd1bWlzM1V4cnF1bDZ4cDZjVVoiLCJtYWMiOiIzNjhkYTU5ZTg5OWUxMTM0ZDlkNzgyMzUxMDk1ZDZmM2U0NjhmMDY4MmU5MGM4Mjg3NjkwYTA0NTQ0ODk2YjdjIiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETpatients" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETpatients"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETpatients"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETpatients" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETpatients">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETpatients" data-method="GET"
      data-path="patients"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETpatients', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETpatients"
                    onclick="tryItOut('GETpatients');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETpatients"
                    onclick="cancelTryOut('GETpatients');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETpatients"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>patients</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETpatients"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETpatients"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETpatients-create">Show the form for creating a new resource.</h2>

<p>
</p>



<span id="example-requests-GETpatients-create">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/patients/create" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patients/create"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETpatients-create">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6IklSdVJISk0wT0N4SkZXY3grejZqR2c9PSIsInZhbHVlIjoiaWdTRVlmSUwzQ2VMR3NoTjNPbG9IZ0ZSbG9VRnJhZStvMVY4UStyd2VKOGd2UlNWc0ZtVWNVdzB0UjArL0IvbUtzNER4ZUZPZ0VuaFNKOWNDaENRU1pic0xpM2tMY1IxTnh6WjRTUngrdittU3B2OU9rbHZ2c1N3b1NicEFzWm0iLCJtYWMiOiIzYjI0NTBjNGU3NzlkY2NmZmMwYTE1ODZlNmY3ODRlOGNhMTQzN2Q0Mjc5MDYyNmQ0NjI4M2U4MjNlNTg3ZGRlIiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; samesite=lax; wsgmed_session=eyJpdiI6InBNSFk5cmtyUTNJYjhRcEZjMGRKcUE9PSIsInZhbHVlIjoiRzRnbk1tVmtKRXpHUDZCcGU0TDVHMWRsdG5pM2pReGd1SHIxS0FHMk0yMkhlSXYxaE1qOFhmZHVGT3hEU1lVeXNTVlFhTWtsUFJrVkZtLy9wL0FwSUlCSHpZd0ZocStKajZiSWhXYVY4Z0hJZlpmd3lMei9vRFcrTHA2TmNtbzUiLCJtYWMiOiIzNTQ3YWIxNzU2MTQ0YmFjNDRmNTc2MWIyMTFjMTkwMGJmMmEwYTJkZDc1ODllZjJhMDM3YjYxYTI1MTM5NDZiIiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETpatients-create" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETpatients-create"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETpatients-create"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETpatients-create" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETpatients-create">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETpatients-create" data-method="GET"
      data-path="patients/create"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETpatients-create', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETpatients-create"
                    onclick="tryItOut('GETpatients-create');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETpatients-create"
                    onclick="cancelTryOut('GETpatients-create');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETpatients-create"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>patients/create</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETpatients-create"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETpatients-create"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTpatients">Store a newly created resource in storage.</h2>

<p>
</p>



<span id="example-requests-POSTpatients">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/patients" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"vmqeopfuudtdsufvyvddq\",
    \"s_name\": \"amniihfqcoynlazghdtqt\",
    \"email\": \"andreanne00@example.org\",
    \"date_of_birth\": \"2025-05-13T19:14:56\",
    \"location_id\": \"consequatur\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patients"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "vmqeopfuudtdsufvyvddq",
    "s_name": "amniihfqcoynlazghdtqt",
    "email": "andreanne00@example.org",
    "date_of_birth": "2025-05-13T19:14:56",
    "location_id": "consequatur"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTpatients">
</span>
<span id="execution-results-POSTpatients" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTpatients"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTpatients"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTpatients" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTpatients">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTpatients" data-method="POST"
      data-path="patients"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTpatients', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTpatients"
                    onclick="tryItOut('POSTpatients');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTpatients"
                    onclick="cancelTryOut('POSTpatients');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTpatients"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>patients</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTpatients"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTpatients"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTpatients"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>s_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="s_name"                data-endpoint="POSTpatients"
               value="amniihfqcoynlazghdtqt"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>amniihfqcoynlazghdtqt</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTpatients"
               value="andreanne00@example.org"
               data-component="body">
    <br>
<p>Must be a valid email address. Must not be greater than 255 characters. Example: <code>andreanne00@example.org</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>date_of_birth</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date_of_birth"                data-endpoint="POSTpatients"
               value="2025-05-13T19:14:56"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2025-05-13T19:14:56</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>location_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="location_id"                data-endpoint="POSTpatients"
               value="consequatur"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the locations table. Example: <code>consequatur</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETpatients--id-">Display the specified resource.</h2>

<p>
</p>



<span id="example-requests-GETpatients--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/patients/17" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patients/17"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETpatients--id-">
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6Ik1GcFpDVUt6ZktQZTg0WWFJemtqVWc9PSIsInZhbHVlIjoiS1J6NGR3VHJGR1lSR1JJRVkzaVREazRTT29kNSs0TGJZanllUWNaTlltbkE0a1g0dnNQa0lMOEdmalN2ZDI1dmFJTmhmTzAzSlg2UzFDcERqc1JJZHdZRTIxYzNXUXNOOXhidXZ3RW9DeFAxNTAzNkwwUHNJc0ZvN0JWczdUaUkiLCJtYWMiOiI1MjE5MDliMTA4MTUzYTAyZTE4Y2UwZTE1OGY3NGQ4Y2VmNWRkMjVhM2E3NzU3ZDEzNWFmZTc5NjZjZmQ3YzkzIiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; samesite=lax; wsgmed_session=eyJpdiI6IjhqcFBKNC9EQXlKZW1nVGpROFh1NlE9PSIsInZhbHVlIjoiY3BiRXphMUpQVnA5cXdCMU1rM05JakNvNVgrWXBuYnBwZ0Q0aDdiMDN3aFRGMXA5d3ZiejlLaFR2VUhOdkU3MDVqZjRiN2dKYkk3N0h3ZkxvYUkwUTFSNTlqdDBQVWUxZDN3RHRydXRjWGN5cDlNRjgzdGlmcXQ0ckZBK09xSFciLCJtYWMiOiIzYWYxNDJjYzY4NzU1NjU5NDczODljMmUyM2NjMGNkNDJiZGZjNWZlMGJhY2QxN2JmNGE5NTQzNzI3OWRmMzBlIiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;No query results for model [App\\Models\\Patient] 17&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETpatients--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETpatients--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETpatients--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETpatients--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETpatients--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETpatients--id-" data-method="GET"
      data-path="patients/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETpatients--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETpatients--id-"
                    onclick="tryItOut('GETpatients--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETpatients--id-"
                    onclick="cancelTryOut('GETpatients--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETpatients--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>patients/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETpatients--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETpatients--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETpatients--id-"
               value="17"
               data-component="url">
    <br>
<p>The ID of the patient. Example: <code>17</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETpatients--patient_id--edit">Show the form for editing the specified resource.</h2>

<p>
</p>



<span id="example-requests-GETpatients--patient_id--edit">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/patients/17/edit" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patients/17/edit"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETpatients--patient_id--edit">
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6Im5LYVVPd0FXZmdEcDlBWGdaSE5CVUE9PSIsInZhbHVlIjoiUnhOSGRaVDloVG03SXNnVkhBQ3BCZFN1a1QxWDQ0QXRlMU4vTjZocFZsNDZLZUk5czQyRFROTHZVT3FDWnVha2MvZWwwdGwzaFJ5UzlqSUlRWkFWQzJyUmc5dFl6OUIrWVVsNXBGQmNhWHI3bXkwR1ozRnBOeko4YTRSM2d6cEUiLCJtYWMiOiJlYmIwMDYzZGU4MTA5MDE5NzAwNjQ0YjIzZjNmZDZmNjBjYTUwNGRlOWMyN2IwNDNjYzVmNGU2MjQ4ODNiMjM4IiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; samesite=lax; wsgmed_session=eyJpdiI6ImExMzJyc0t0OVFCR3pZM3FIbVlHZkE9PSIsInZhbHVlIjoiMFV4ZTZsTDAraHNHakNQQVZPYk5RbEVIbTNXVnJTb0pRckYzSnFHTWZ2QnZOUkFGeS83OHRnMUpDOE9EdExFQzJoa2hqWDE4QmZZS1NPZUdPQ1Ywb0tuTGNGRk1qbjZQdGdjVnhoaFdxTDlKTjR4SUZzK0piTVhPSVBWUDlRQkwiLCJtYWMiOiIxNzkyODJlMDFjYTljNzEyZmJmZDljZDZlNmU0NTMyYmY0YWY1MmE5ZjRkZjUwZjU2MDI1N2NmNjM1ZmNlNTg0IiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;No query results for model [App\\Models\\Patient] 17&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETpatients--patient_id--edit" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETpatients--patient_id--edit"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETpatients--patient_id--edit"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETpatients--patient_id--edit" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETpatients--patient_id--edit">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETpatients--patient_id--edit" data-method="GET"
      data-path="patients/{patient_id}/edit"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETpatients--patient_id--edit', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETpatients--patient_id--edit"
                    onclick="tryItOut('GETpatients--patient_id--edit');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETpatients--patient_id--edit"
                    onclick="cancelTryOut('GETpatients--patient_id--edit');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETpatients--patient_id--edit"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>patients/{patient_id}/edit</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETpatients--patient_id--edit"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETpatients--patient_id--edit"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>patient_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="patient_id"                data-endpoint="GETpatients--patient_id--edit"
               value="17"
               data-component="url">
    <br>
<p>The ID of the patient. Example: <code>17</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTpatients--id-">Update the specified resource in storage.</h2>

<p>
</p>



<span id="example-requests-PUTpatients--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/patients/17" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"vmqeopfuudtdsufvyvddq\",
    \"s_name\": \"amniihfqcoynlazghdtqt\",
    \"email\": \"andreanne00@example.org\",
    \"date_of_birth\": \"2025-05-13T19:14:56\",
    \"location_id\": \"consequatur\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patients/17"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "vmqeopfuudtdsufvyvddq",
    "s_name": "amniihfqcoynlazghdtqt",
    "email": "andreanne00@example.org",
    "date_of_birth": "2025-05-13T19:14:56",
    "location_id": "consequatur"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTpatients--id-">
</span>
<span id="execution-results-PUTpatients--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTpatients--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTpatients--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTpatients--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTpatients--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTpatients--id-" data-method="PUT"
      data-path="patients/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTpatients--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTpatients--id-"
                    onclick="tryItOut('PUTpatients--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTpatients--id-"
                    onclick="cancelTryOut('PUTpatients--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTpatients--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>patients/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>patients/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTpatients--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTpatients--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTpatients--id-"
               value="17"
               data-component="url">
    <br>
<p>The ID of the patient. Example: <code>17</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTpatients--id-"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>s_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="s_name"                data-endpoint="PUTpatients--id-"
               value="amniihfqcoynlazghdtqt"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>amniihfqcoynlazghdtqt</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="PUTpatients--id-"
               value="andreanne00@example.org"
               data-component="body">
    <br>
<p>Must be a valid email address. Must not be greater than 255 characters. Example: <code>andreanne00@example.org</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>date_of_birth</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date_of_birth"                data-endpoint="PUTpatients--id-"
               value="2025-05-13T19:14:56"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2025-05-13T19:14:56</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>location_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="location_id"                data-endpoint="PUTpatients--id-"
               value="consequatur"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the locations table. Example: <code>consequatur</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEpatients--id-">Remove the specified resource from storage.</h2>

<p>
</p>



<span id="example-requests-DELETEpatients--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/patients/17" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patients/17"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEpatients--id-">
</span>
<span id="execution-results-DELETEpatients--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEpatients--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEpatients--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEpatients--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEpatients--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEpatients--id-" data-method="DELETE"
      data-path="patients/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEpatients--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEpatients--id-"
                    onclick="tryItOut('DELETEpatients--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEpatients--id-"
                    onclick="cancelTryOut('DELETEpatients--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEpatients--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>patients/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEpatients--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEpatients--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEpatients--id-"
               value="17"
               data-component="url">
    <br>
<p>The ID of the patient. Example: <code>17</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETmedications">Display a listing of the resource.</h2>

<p>
</p>



<span id="example-requests-GETmedications">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/medications" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/medications"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETmedications">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6IkR4MlpRRjNrYnF4NmQ1OXljbWtvMmc9PSIsInZhbHVlIjoiZ3BiNW9mMVRBVGltbmZ0QldPcFErYXp3OUFrY2VmdGl4Q1FlWmF1RjNva3ZsZGhJcU5hcEpFOFhlaEN2NkFLaGNvUVhhY1JVVDZOck5IOVVDTzdCSWxtWEozSWdmdEwyd1B4SzMxbm9FZWdJT1ZvbXRiS2dlTTdvOC9CV1VETnEiLCJtYWMiOiI4NjliMWE2ZGQ5NTI0OGE5YmIwNTA1NDBkOTgwOTQ4YWU1MDZjYjQ1YzJiNTA1MjY2NTk4M2ExODg4NjAxYTkyIiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; samesite=lax; wsgmed_session=eyJpdiI6IklFZ0pVQXJFczlIQ0lLUGh1aVVaN0E9PSIsInZhbHVlIjoiUHJkTTR6YWM5cE9RSmRNbUdpaHFFaE5tSlltaDRJa3lFdmxKemRmMjBWVDFMb3BKM3g2MW8zcHc0MjdUT1NpUmF5ZjdrRXlUekJ3MCtMTGwyUFh1bW1VSDdwc0JPaStDalVxMkdCWUc0ZE0vSGs4YVVCUkYrOWR0K2dSdjJsK2IiLCJtYWMiOiJkNjU1MmUwZjRmNDlkMjE2NmJjZTUwZDFiOTg3YjA4MzJhMGI4YjRlMTk0OTZlNzJkYzc2ZTQ0Y2RlNTkxNTg0IiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETmedications" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETmedications"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETmedications"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETmedications" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETmedications">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETmedications" data-method="GET"
      data-path="medications"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETmedications', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETmedications"
                    onclick="tryItOut('GETmedications');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETmedications"
                    onclick="cancelTryOut('GETmedications');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETmedications"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>medications</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETmedications"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETmedications"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETmedications-create">Show the form for creating a new resource.</h2>

<p>
</p>



<span id="example-requests-GETmedications-create">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/medications/create" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/medications/create"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETmedications-create">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6IjF1MlEySmFqbkhlVm10WHkzVUpyS2c9PSIsInZhbHVlIjoiZDk4R2Fmak5ZWW9INDU2QWdubVZsVXBwNUJDdGhBeVM4SU5jcmF1SHNUWUtyZE1iUUZJUStiQ0ZmSDMwbzhhZ3FlWUZ4TkVDSkMvaDREdXIrQ016U0xzRFBTT0pxT2VMUTN6TzE2Q3JheGdwUE1BL1RFMncrMTl1NkhtemFwSkUiLCJtYWMiOiIwYTI2OTE5Njg4Y2Y4ZWE1ZTRiYjJmMGUyYmQzZjgwZTRmOTFlYmI0ZjM5MjEwNzcwODkyNzk3YWUyZTNhNGQwIiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; samesite=lax; wsgmed_session=eyJpdiI6Ik4wRmlaWVFObllpL0p6d1B6U3lRbUE9PSIsInZhbHVlIjoiODBPRUFnQk16OWM0QVJkVFdIMllPcXQ5eUE0UHFXejI1VjBocmhPSnhvWTIvSXZ2NGFjTmZpaS9XV1NmMlRZUFhPT21lei9WUjh2a25KTVBEcHJtNnZUbXpybmYzdmR6TWcwa1hDNjhTNW56aVZiUWFSRlJEOWpTekhQdWc1SWgiLCJtYWMiOiJmMGJhM2QwMzI1ZTc0OTBlOGE2MDM0ZmE2MDBiMDEwYzQ5YjA3M2U4NjZiYzRlNWMyNDMxNTc2ZmM1NmEwZjM1IiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETmedications-create" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETmedications-create"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETmedications-create"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETmedications-create" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETmedications-create">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETmedications-create" data-method="GET"
      data-path="medications/create"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETmedications-create', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETmedications-create"
                    onclick="tryItOut('GETmedications-create');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETmedications-create"
                    onclick="cancelTryOut('GETmedications-create');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETmedications-create"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>medications/create</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETmedications-create"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETmedications-create"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTmedications">Store a newly created resource in storage.</h2>

<p>
</p>



<span id="example-requests-POSTmedications">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/medications" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"vmqeopfuudtdsufvyvddq\",
    \"info\": \"consequatur\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/medications"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "vmqeopfuudtdsufvyvddq",
    "info": "consequatur"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTmedications">
</span>
<span id="execution-results-POSTmedications" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTmedications"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTmedications"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTmedications" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTmedications">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTmedications" data-method="POST"
      data-path="medications"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTmedications', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTmedications"
                    onclick="tryItOut('POSTmedications');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTmedications"
                    onclick="cancelTryOut('POSTmedications');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTmedications"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>medications</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTmedications"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTmedications"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTmedications"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>info</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="info"                data-endpoint="POSTmedications"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETmedications--id-">Display the specified resource.</h2>

<p>
</p>



<span id="example-requests-GETmedications--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/medications/17" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/medications/17"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETmedications--id-">
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6Ik00R2w3Tm56MkY5M3FFbVdSc0tvSXc9PSIsInZhbHVlIjoiSS9FSmZDaE1COFBBR1g5dDlDNHdKc0gzNmZWbmpDQjVwcXprdmNkWENKSlY5STloMCtPZXRpZWdTamRGc1JuTDYxQzI0ZlIveG84UHhsZzhDM2ZCbWY1MVFnUjhqTitwbi9UbTdYWEtFSEhFejVlZFFkZjFNY2dVMmkrUjEzRnQiLCJtYWMiOiI3NjY3YTE2YWQ1ZTM0NmZlM2I2YmZhNDlhNjZlN2U1NDNiZTRmMGJkNzYzNzI2YjNlZDU4MjBjYTA2YTRiYzBhIiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; samesite=lax; wsgmed_session=eyJpdiI6ImIvOXFmMUFkY3pPSnBGOW1zc1l0dUE9PSIsInZhbHVlIjoiTWtwZDJDWmN5NldmM3NDbTdvZE1STFlBaUVSUGhwZnBjT2orL1N0czNab2JVQ0EvM0JJOTZIVnkyQy9tTFA5WXJzdXVSUkJEUVBIdExlV3JMaWkzU2srdWsyQ0pIMnFHa0xPWTJlYVZhaUZpdnc5dkpDRXN1ckd6bXJaSG5qRHQiLCJtYWMiOiI0NWVkOWY4NWFkZjI2NWQ5MTk1MDc3N2NkZjhiZTVhODUwMDY5NDk3ODVjMGIxNDc0ODlkZWNjOTJjZDA3ZjJiIiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;No query results for model [App\\Models\\Medication] 17&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETmedications--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETmedications--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETmedications--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETmedications--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETmedications--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETmedications--id-" data-method="GET"
      data-path="medications/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETmedications--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETmedications--id-"
                    onclick="tryItOut('GETmedications--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETmedications--id-"
                    onclick="cancelTryOut('GETmedications--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETmedications--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>medications/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETmedications--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETmedications--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETmedications--id-"
               value="17"
               data-component="url">
    <br>
<p>The ID of the medication. Example: <code>17</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETmedications--medication_id--edit">Show the form for editing the specified resource.</h2>

<p>
</p>



<span id="example-requests-GETmedications--medication_id--edit">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/medications/17/edit" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/medications/17/edit"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETmedications--medication_id--edit">
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6ImhWbFFqVVkrU3dYazBmdUtBS2xFK2c9PSIsInZhbHVlIjoia2UwSmdndm5kUHVLUGtrTlBhWTc4ZXNmNmo3NEwvRndNOEdSTjN4NUNRQVRWNGtMbjhvVUpoUFN1UGpPTnlVNmI1eDNaQkprWmhIK0JyWmZpTDllcnBxNHRkcVNOY0QyYkRnODVSSnNWNU5paXpuQVlvRzBudm5ucHZkelB0QnQiLCJtYWMiOiIyYjI0NmI2MTZjOTdiZDViNjdmNDVmZTE2MzNmNDdkMzljNDU5ZmEzZWU4YTE1NzkxMmZiZmNmZjVjNGI4MzJjIiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; samesite=lax; wsgmed_session=eyJpdiI6IlRkcEF5MVhhMXB1dDRHZXQ3bG5YR2c9PSIsInZhbHVlIjoibFloQ0wzcnRRK25lUU5aU1ZMdUdKbGF6SUZIRXpac2lOSTYxTTB3amhkdDFFK1FhYzBwdDZla0RFT0NreU45WjRvdGxjSlYrZHNKTXVwd2dVRDFMM1RJS052VTArVUsrNERzMjRVTWVWNjlIQmlaOXlpQXkrY1VRMHB5WmFoVVoiLCJtYWMiOiI1MmRkZWJlOTFlMmU5ZjIwNjAxMGZjNmU0NjAwM2M3OTA4YTkyZTFhMjBkZjAwM2RlODM0Zjk0OWM5YTQ2MzQ4IiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;No query results for model [App\\Models\\Medication] 17&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETmedications--medication_id--edit" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETmedications--medication_id--edit"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETmedications--medication_id--edit"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETmedications--medication_id--edit" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETmedications--medication_id--edit">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETmedications--medication_id--edit" data-method="GET"
      data-path="medications/{medication_id}/edit"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETmedications--medication_id--edit', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETmedications--medication_id--edit"
                    onclick="tryItOut('GETmedications--medication_id--edit');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETmedications--medication_id--edit"
                    onclick="cancelTryOut('GETmedications--medication_id--edit');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETmedications--medication_id--edit"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>medications/{medication_id}/edit</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETmedications--medication_id--edit"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETmedications--medication_id--edit"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>medication_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="medication_id"                data-endpoint="GETmedications--medication_id--edit"
               value="17"
               data-component="url">
    <br>
<p>The ID of the medication. Example: <code>17</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTmedications--id-">Update the specified resource in storage.</h2>

<p>
</p>



<span id="example-requests-PUTmedications--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/medications/17" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"vmqeopfuudtdsufvyvddq\",
    \"info\": \"consequatur\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/medications/17"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "vmqeopfuudtdsufvyvddq",
    "info": "consequatur"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTmedications--id-">
</span>
<span id="execution-results-PUTmedications--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTmedications--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTmedications--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTmedications--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTmedications--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTmedications--id-" data-method="PUT"
      data-path="medications/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTmedications--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTmedications--id-"
                    onclick="tryItOut('PUTmedications--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTmedications--id-"
                    onclick="cancelTryOut('PUTmedications--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTmedications--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>medications/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>medications/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTmedications--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTmedications--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTmedications--id-"
               value="17"
               data-component="url">
    <br>
<p>The ID of the medication. Example: <code>17</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTmedications--id-"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>info</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="info"                data-endpoint="PUTmedications--id-"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEmedications--id-">Remove the specified resource from storage.</h2>

<p>
</p>



<span id="example-requests-DELETEmedications--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/medications/17" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/medications/17"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEmedications--id-">
</span>
<span id="execution-results-DELETEmedications--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEmedications--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEmedications--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEmedications--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEmedications--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEmedications--id-" data-method="DELETE"
      data-path="medications/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEmedications--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEmedications--id-"
                    onclick="tryItOut('DELETEmedications--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEmedications--id-"
                    onclick="cancelTryOut('DELETEmedications--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEmedications--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>medications/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEmedications--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEmedications--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEmedications--id-"
               value="17"
               data-component="url">
    <br>
<p>The ID of the medication. Example: <code>17</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETlocations">Display a listing of the resource.</h2>

<p>
</p>



<span id="example-requests-GETlocations">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/locations" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/locations"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETlocations">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6IlEva1RMV25NY1VoOU5wVXR2OGRGZVE9PSIsInZhbHVlIjoiS0NnSXVMcHdLZ2tBS2RhZjhnWGUyZGRnT1FvWnFkL1JETHpPSTBZZlN4TWJzTlUyTUJhUzRCRmYzQWZ2VXZ3dzRYMzhtcktqc3IwN0hNMmp2c3pNdUNoVzEybUNxUGdjbitxT09WMDJqRE9IWGY0V2tTQUgzQ28vWlp3a3lkUGciLCJtYWMiOiI1MzllNTVkNzA1ZTc1ODUxY2VlNmQzOTIzOTNmNDk0YTQyMDFiZDBlYjQ2YWRmMGNhZmNmMGRkMTllNzNkMjVkIiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; samesite=lax; wsgmed_session=eyJpdiI6IjFlbUtLZ1ZDbm8wQnkrWEJEdCtHZkE9PSIsInZhbHVlIjoiS1AySmJLNy9VYnZMYUtJNDVBQ3BxaFhEcmUzQ3YzTGxSZWZyUWFqdkFtQkJIbTRRYnJORkxnVUVOYU8vZEl2Q1puTnJSRGt5bCtXekQzeHFGYU14bkphOEluUzFkbk9rdzYwN201THAvemhHSUREbkJua2xwNnpwTkZmK0t3bHYiLCJtYWMiOiJkOWVjM2U2N2I3M2E2MmNmOWU5Zjk2Y2NhZjk3MGU1YjZiOTZmYmFhNjdmMzQ0MzYwNzBkZThmZDE4OWE4ZmFiIiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETlocations" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETlocations"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETlocations"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETlocations" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETlocations">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETlocations" data-method="GET"
      data-path="locations"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETlocations', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETlocations"
                    onclick="tryItOut('GETlocations');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETlocations"
                    onclick="cancelTryOut('GETlocations');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETlocations"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>locations</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETlocations"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETlocations"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETlocations-create">Show the form for creating a new resource.</h2>

<p>
</p>



<span id="example-requests-GETlocations-create">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/locations/create" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/locations/create"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETlocations-create">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6InJOTXVGTzlGbmNVeEVsU3B0Witac1E9PSIsInZhbHVlIjoiRU0weXVRQ3puMXYvSVFpNEVsZXc4T0o3VG1LVzBJU2ZnK09oMzQ1bXllOVdYSEZPUVhTZjdmSkxZOHBVZTlYcEFqWnduYnFudlgzTlZBTHNmdTl5U1FsRE8zaFBtUnF5dGswY2psdTBmeFVBS21MT1cvWEthdHIxaVVOb3RCYkMiLCJtYWMiOiJmZGUzYTYzYjYwMjVmYmFmMmQ0N2M3MTYyMDFiMThhNTQ3MTEyMmYyYTRlYzIzOTBhMzI4ZGZjNjRhYzAxN2RjIiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; samesite=lax; wsgmed_session=eyJpdiI6Im5xQXNrM3RzS0ZySFZUcEhZR1NLYmc9PSIsInZhbHVlIjoiL0JBUjEzNzZsZ3hjdVFpY3dPWi84czMxSjhzUzk5dmxqZ1ZSUHEyT29Ubko3cVo4dkY1cXJZblhkY292SW9ySkhkcTdUbVVON3FEQlZBRzBuZHdQVE1LSnM0bEN3bEVGb3lzTnBYbGNGWWZEYTU2Wmo0TDlaaWdkcndkbzdrem4iLCJtYWMiOiI3OTcyY2YwNmI2OTA0YTI4NWMwMmE3Njg3NzJmZTc1ODk4MDcxZmU0NjNjMGI3NmZhNzM2NDk2Njc0MzkzODYyIiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETlocations-create" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETlocations-create"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETlocations-create"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETlocations-create" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETlocations-create">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETlocations-create" data-method="GET"
      data-path="locations/create"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETlocations-create', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETlocations-create"
                    onclick="tryItOut('GETlocations-create');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETlocations-create"
                    onclick="cancelTryOut('GETlocations-create');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETlocations-create"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>locations/create</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETlocations-create"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETlocations-create"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTlocations">Store a newly created resource in storage.</h2>

<p>
</p>



<span id="example-requests-POSTlocations">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/locations" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"room\": \"vmqeopfuudtdsufvyvddq\",
    \"floor\": 17,
    \"limit\": 17
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/locations"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "room": "vmqeopfuudtdsufvyvddq",
    "floor": 17,
    "limit": 17
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTlocations">
</span>
<span id="execution-results-POSTlocations" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTlocations"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTlocations"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTlocations" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTlocations">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTlocations" data-method="POST"
      data-path="locations"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTlocations', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTlocations"
                    onclick="tryItOut('POSTlocations');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTlocations"
                    onclick="cancelTryOut('POSTlocations');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTlocations"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>locations</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTlocations"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTlocations"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>room</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="room"                data-endpoint="POSTlocations"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>floor</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="floor"                data-endpoint="POSTlocations"
               value="17"
               data-component="body">
    <br>
<p>Example: <code>17</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>limit</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="limit"                data-endpoint="POSTlocations"
               value="17"
               data-component="body">
    <br>
<p>Example: <code>17</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETlocations--id-">Display the specified resource.</h2>

<p>
</p>



<span id="example-requests-GETlocations--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/locations/17" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/locations/17"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETlocations--id-">
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6ImpWbDl0UEZXVkZVRXgwT3NvYXpMOGc9PSIsInZhbHVlIjoiOXJ3dTlpeWprbnBleGxrUWlKNzlDNXE3cjZFTDZyeE41ME5UV1pmZmNSeXhPQnpxSXZuOXJYazRML3FZWHExMXd0cHFiK0YrTzY3b05YVkR2U0RSeDNVUnIvc3JZU2ViYUZSNHVOT2QrcGdoVzlEUmtwQU9BSTlBVkNHc2dQcVoiLCJtYWMiOiI2ZTNiNWE4YTU4NDQ5NTNhZmFlZjI5NjcwMWM2Yzc5MmQxYmQ1MGZkODc5Y2MwZmI3YmM0ZDRmMTJlYTA3M2I0IiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; samesite=lax; wsgmed_session=eyJpdiI6IjZiWjEzM0gzeXlUdWJUWGJQYldxbVE9PSIsInZhbHVlIjoiQVg3QTROb2FhRHVWTkJuUi9QcFlxUXBYYklUZkI0NmFyd0xMTk9FRWJPOVMxdG5WZDZHZXhjY0NUbFROT0xaQ0xWeFJad3MzZE1tR0hRcWRMbDVRcW0wUXVLM045bXk4cVFkR2ZlRW0wWXljdjBwdzIyQnF5TVhLeTMyTytxV0oiLCJtYWMiOiIyOThmMDFjY2YyN2NlYzdkMjM2ZDcxN2ZjZDZkM2JlZmQ5ZWVmY2M1YjRjOWQ1M2JhZGRlZmNkZWQ3YjZmNDc0IiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;No query results for model [App\\Models\\Location] 17&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETlocations--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETlocations--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETlocations--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETlocations--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETlocations--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETlocations--id-" data-method="GET"
      data-path="locations/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETlocations--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETlocations--id-"
                    onclick="tryItOut('GETlocations--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETlocations--id-"
                    onclick="cancelTryOut('GETlocations--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETlocations--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>locations/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETlocations--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETlocations--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETlocations--id-"
               value="17"
               data-component="url">
    <br>
<p>The ID of the location. Example: <code>17</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETlocations--location_id--edit">Show the form for editing the specified resource.</h2>

<p>
</p>



<span id="example-requests-GETlocations--location_id--edit">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/locations/17/edit" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/locations/17/edit"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETlocations--location_id--edit">
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6InA0ZWJ1WUZKYlcrS2ltQzNsQjVvc1E9PSIsInZhbHVlIjoiT2IvOEJ3ZWgvL2VsaTZ1THhQeEdydVNQUzRkOFZ3aEtsTjA4SFdvSUpmeVZkWHUzOU1IL05ucnphOTZiMXM1cnlwVkFzMFl6T1N5SnF0Rkw3LyszcXVHMkowTVpWVXc5UjF5cEpnem9zRlhTaS91amlPdkFyb3RkbnBmOGd6OFYiLCJtYWMiOiJiYzRiNjhiMWUzMTJjMWIwN2M0MGFiYTBmM2I1ZmIxMDdmNWQ5OTY4ZWM4NDVhY2I0ODc4YTQ5NjVjZGRmMGJhIiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; samesite=lax; wsgmed_session=eyJpdiI6InVUdGk5ZGpZSEV1NG1JUnRPb0hQSmc9PSIsInZhbHVlIjoiRHVCYmdGNDVmWFpybzhWb0ZoTzNuNmFidnNlOWZ0aDBibjJWNkhGZHRQOXhWQjQySERUVnRvRmpuQ0dkb2FXVVgwTnpiaElWeDhtTkxPZGlVYzMvYlRWNS8xTEJFWFFBTGtLUS9Gc01lY0ZxZ1ZNN2ppNmQwTTZxRkpFQ3QwQ04iLCJtYWMiOiI0NmZiZjA3NTQ0MjMwN2JlNzVjZDNhZmFiODQyOGNlM2RkNzRhYjA0NjNjYWRlMmM2MmRlNGQzODdiYWY5YTM2IiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;No query results for model [App\\Models\\Location] 17&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETlocations--location_id--edit" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETlocations--location_id--edit"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETlocations--location_id--edit"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETlocations--location_id--edit" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETlocations--location_id--edit">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETlocations--location_id--edit" data-method="GET"
      data-path="locations/{location_id}/edit"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETlocations--location_id--edit', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETlocations--location_id--edit"
                    onclick="tryItOut('GETlocations--location_id--edit');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETlocations--location_id--edit"
                    onclick="cancelTryOut('GETlocations--location_id--edit');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETlocations--location_id--edit"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>locations/{location_id}/edit</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETlocations--location_id--edit"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETlocations--location_id--edit"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>location_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="location_id"                data-endpoint="GETlocations--location_id--edit"
               value="17"
               data-component="url">
    <br>
<p>The ID of the location. Example: <code>17</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTlocations--id-">Update the specified resource in storage.</h2>

<p>
</p>



<span id="example-requests-PUTlocations--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/locations/17" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"room\": \"vmqeopfuudtdsufvyvddq\",
    \"floor\": 17,
    \"limit\": 17
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/locations/17"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "room": "vmqeopfuudtdsufvyvddq",
    "floor": 17,
    "limit": 17
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTlocations--id-">
</span>
<span id="execution-results-PUTlocations--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTlocations--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTlocations--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTlocations--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTlocations--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTlocations--id-" data-method="PUT"
      data-path="locations/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTlocations--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTlocations--id-"
                    onclick="tryItOut('PUTlocations--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTlocations--id-"
                    onclick="cancelTryOut('PUTlocations--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTlocations--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>locations/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>locations/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTlocations--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTlocations--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTlocations--id-"
               value="17"
               data-component="url">
    <br>
<p>The ID of the location. Example: <code>17</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>room</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="room"                data-endpoint="PUTlocations--id-"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>floor</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="floor"                data-endpoint="PUTlocations--id-"
               value="17"
               data-component="body">
    <br>
<p>Example: <code>17</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>limit</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="limit"                data-endpoint="PUTlocations--id-"
               value="17"
               data-component="body">
    <br>
<p>Example: <code>17</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETElocations--id-">Remove the specified resource from storage.</h2>

<p>
</p>



<span id="example-requests-DELETElocations--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/locations/17" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/locations/17"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETElocations--id-">
</span>
<span id="execution-results-DELETElocations--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETElocations--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETElocations--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETElocations--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETElocations--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETElocations--id-" data-method="DELETE"
      data-path="locations/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETElocations--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETElocations--id-"
                    onclick="tryItOut('DELETElocations--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETElocations--id-"
                    onclick="cancelTryOut('DELETElocations--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETElocations--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>locations/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETElocations--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETElocations--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETElocations--id-"
               value="17"
               data-component="url">
    <br>
<p>The ID of the location. Example: <code>17</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETpatients--patient_id--medical_records-create">Show the form for creating a new resource.</h2>

<p>
</p>



<span id="example-requests-GETpatients--patient_id--medical_records-create">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/patients/17/medical_records/create" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patients/17/medical_records/create"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETpatients--patient_id--medical_records-create">
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6IjFJT21VZmNQNEg5a1VWeG5WTmNPcGc9PSIsInZhbHVlIjoidWtGWENXNlZXVmlYTy9UUlNuWTA3M3NOaUxDMWNFVU15VmRmVlJMZlBadmg1bWZnUzFCRE55S1NOTXA0azcza1Awd1dMTDEzRkM0V0JENnl0S2xPS1hUVk5pT2dLS0VtZmxsTUJHZDkrYmk1Q2RRT080MERaNi9KbkVFVkFqb0MiLCJtYWMiOiJjNWVkYzY5OGQ4MjgzZjEyYzQ3OTRkZmE1ZWNjMDE0OTQ2ODc4ZTg3ZjQ2ZDQ3MWFiNjQzN2JkY2I0MjAyZjI0IiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; samesite=lax; wsgmed_session=eyJpdiI6ImU3cXZnWmNSM2lkMDY0RHA1cTZvcXc9PSIsInZhbHVlIjoiMVJHZlRDZFFRK0g0YXhMNWlleGJBWG56VUZVSVJjWGVGc2lmRW5JcVU3SWlrR1FpS0hlZW0wMGlUeVZYT2hBaXVLSWs1bXB2ZS93dFdnTVdVN0I0M0k3VjZwbjVtc2sxRVptR2k5SXFSSTZYdW56MmhvWmtIZUJlVHdzNVFWM00iLCJtYWMiOiI3ZjkxY2I1MzM3MWU0MGEzMjcxMWVjZTM5ZWM1NDdjN2YyYTIwZmQwZmJiYjJhYTI2MjIxNDlhOTIwMjA0MjI2IiwidGFnIjoiIn0%3D; expires=Tue, 13 May 2025 21:14:56 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;No query results for model [App\\Models\\Patient] 17&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETpatients--patient_id--medical_records-create" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETpatients--patient_id--medical_records-create"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETpatients--patient_id--medical_records-create"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETpatients--patient_id--medical_records-create" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETpatients--patient_id--medical_records-create">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETpatients--patient_id--medical_records-create" data-method="GET"
      data-path="patients/{patient_id}/medical_records/create"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETpatients--patient_id--medical_records-create', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETpatients--patient_id--medical_records-create"
                    onclick="tryItOut('GETpatients--patient_id--medical_records-create');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETpatients--patient_id--medical_records-create"
                    onclick="cancelTryOut('GETpatients--patient_id--medical_records-create');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETpatients--patient_id--medical_records-create"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>patients/{patient_id}/medical_records/create</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETpatients--patient_id--medical_records-create"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETpatients--patient_id--medical_records-create"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>patient_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="patient_id"                data-endpoint="GETpatients--patient_id--medical_records-create"
               value="17"
               data-component="url">
    <br>
<p>The ID of the patient. Example: <code>17</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTmedical-records">Store a newly created resource in storage.</h2>

<p>
</p>



<span id="example-requests-POSTmedical-records">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/medical-records" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"patient_id\": \"consequatur\",
    \"record_date\": \"2025-05-13T19:14:56\",
    \"blood_pressure\": 11613.31890586,
    \"temperature\": 11613.31890586,
    \"pulse\": 11613.31890586,
    \"weight\": 11613.31890586,
    \"mood\": 2,
    \"pain_level\": 2,
    \"oxygen_saturation\": 11613.31890586
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/medical-records"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "patient_id": "consequatur",
    "record_date": "2025-05-13T19:14:56",
    "blood_pressure": 11613.31890586,
    "temperature": 11613.31890586,
    "pulse": 11613.31890586,
    "weight": 11613.31890586,
    "mood": 2,
    "pain_level": 2,
    "oxygen_saturation": 11613.31890586
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTmedical-records">
</span>
<span id="execution-results-POSTmedical-records" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTmedical-records"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTmedical-records"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTmedical-records" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTmedical-records">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTmedical-records" data-method="POST"
      data-path="medical-records"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTmedical-records', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTmedical-records"
                    onclick="tryItOut('POSTmedical-records');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTmedical-records"
                    onclick="cancelTryOut('POSTmedical-records');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTmedical-records"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>medical-records</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTmedical-records"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTmedical-records"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>patient_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="patient_id"                data-endpoint="POSTmedical-records"
               value="consequatur"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the patients table. Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>record_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="record_date"                data-endpoint="POSTmedical-records"
               value="2025-05-13T19:14:56"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2025-05-13T19:14:56</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>blood_pressure</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="blood_pressure"                data-endpoint="POSTmedical-records"
               value="11613.31890586"
               data-component="body">
    <br>
<p>Example: <code>11613.31890586</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>temperature</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="temperature"                data-endpoint="POSTmedical-records"
               value="11613.31890586"
               data-component="body">
    <br>
<p>Example: <code>11613.31890586</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>pulse</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="pulse"                data-endpoint="POSTmedical-records"
               value="11613.31890586"
               data-component="body">
    <br>
<p>Example: <code>11613.31890586</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>weight</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="weight"                data-endpoint="POSTmedical-records"
               value="11613.31890586"
               data-component="body">
    <br>
<p>Example: <code>11613.31890586</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>mood</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="mood"                data-endpoint="POSTmedical-records"
               value="2"
               data-component="body">
    <br>
<p>Must be between 1 and 10. Example: <code>2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>pain_level</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="pain_level"                data-endpoint="POSTmedical-records"
               value="2"
               data-component="body">
    <br>
<p>Must be between 1 and 10. Example: <code>2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>oxygen_saturation</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="oxygen_saturation"                data-endpoint="POSTmedical-records"
               value="11613.31890586"
               data-component="body">
    <br>
<p>Example: <code>11613.31890586</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEmedical_records--medicalRecord_id-">Remove the specified resource from storage.</h2>

<p>
</p>



<span id="example-requests-DELETEmedical_records--medicalRecord_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/medical_records/17" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/medical_records/17"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEmedical_records--medicalRecord_id-">
</span>
<span id="execution-results-DELETEmedical_records--medicalRecord_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEmedical_records--medicalRecord_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEmedical_records--medicalRecord_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEmedical_records--medicalRecord_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEmedical_records--medicalRecord_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEmedical_records--medicalRecord_id-" data-method="DELETE"
      data-path="medical_records/{medicalRecord_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEmedical_records--medicalRecord_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEmedical_records--medicalRecord_id-"
                    onclick="tryItOut('DELETEmedical_records--medicalRecord_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEmedical_records--medicalRecord_id-"
                    onclick="cancelTryOut('DELETEmedical_records--medicalRecord_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEmedical_records--medicalRecord_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>medical_records/{medicalRecord_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEmedical_records--medicalRecord_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEmedical_records--medicalRecord_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>medicalRecord_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="medicalRecord_id"                data-endpoint="DELETEmedical_records--medicalRecord_id-"
               value="17"
               data-component="url">
    <br>
<p>The ID of the medicalRecord. Example: <code>17</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETstorage--path-">GET storage/{path}</h2>

<p>
</p>



<span id="example-requests-GETstorage--path-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/storage/2UZ5i" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/storage/2UZ5i"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETstorage--path-">
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETstorage--path-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETstorage--path-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETstorage--path-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETstorage--path-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETstorage--path-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETstorage--path-" data-method="GET"
      data-path="storage/{path}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETstorage--path-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETstorage--path-"
                    onclick="tryItOut('GETstorage--path-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETstorage--path-"
                    onclick="cancelTryOut('GETstorage--path-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETstorage--path-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>storage/{path}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETstorage--path-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETstorage--path-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>path</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="path"                data-endpoint="GETstorage--path-"
               value="2UZ5i"
               data-component="url">
    <br>
<p>Example: <code>2UZ5i</code></p>
            </div>
                    </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
