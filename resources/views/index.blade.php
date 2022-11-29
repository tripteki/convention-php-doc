<!DOCTYPE html>
<html>
<head>
<title>{{ config('l5-swagger.documentations.'.$documentation.'.api.title') }}</title>
<meta charset="UTF-8" />
<link rel="icon" type="image/png" href="{{ l5_swagger_asset($documentation, 'favicon-32x32.png') }}" sizes="32x32" />
<link rel="icon" type="image/png" href="{{ l5_swagger_asset($documentation, 'favicon-16x16.png') }}" sizes="16x16" />
<link rel="stylesheet" type="text/css" href="{{ l5_swagger_asset($documentation, 'swagger-ui.css') }}" />
<style type="text/css">
html
{
    box-sizing: border-box;
    overflow: -moz-scrollbars-vertical;
    overflow-y: scroll;
}

*, *:before, *:after
{
    box-sizing: inherit;
}

body
{
    margin: 0;
    background: #fafafa;
}
</style>
</head>

<body>

<div id="swagger"></div>

<script type="text/javascript" src="{{ l5_swagger_asset($documentation, 'swagger-ui-bundle.js') }}"></script>
<script type="text/javascript" src="{{ l5_swagger_asset($documentation, 'swagger-ui-standalone-preset.js') }}"></script>
<script type="text/javascript">
window.onload = function ()
{
    const swagger = SwaggerUIBundle(
    {
        dom_id: "#swagger",

        url: "{!! $urlToDocs !!}",
        operationsSorter: {!! isset($operationsSorter) ? '"'.$operationsSorter.'"' : 'null' !!},
        configUrl: {!! isset($configUrl) ? '"'.$configUrl.'"' : 'null' !!},
        validatorUrl: {!! isset($validatorUrl) ? '"'.$validatorUrl.'"' : 'null' !!},
        oauth2RedirectUrl: "{{ route('l5-swagger.'.$documentation.'.oauth2_callback', [], $useAbsolutePath) }}",
        layout: "StandaloneLayout",
        docExpansion : "{!! config('l5-swagger.defaults.ui.display.doc_expansion', 'none') !!}",
        deepLinking: true,
        filter: {!! config('l5-swagger.defaults.ui.display.filter') ? 'true' : 'false' !!},
        persistAuthorization: "{!! config('l5-swagger.defaults.ui.authorization.persist_authorization') ? 'true' : 'false' !!}",

        requestInterceptor: function (request) {

            request.headers['X-CSRF-TOKEN'] = '{{ csrf_token() }}';

            return request;
        },

        presets: [

            SwaggerUIBundle.presets.apis,
            SwaggerUIStandalonePreset,
        ],

        plugins: [

            SwaggerUIBundle.plugins.DownloadUrl,
        ],
    });

    window.swagger = swagger;

    @if(in_array("oauth2", array_column(config("l5-swagger.defaults.securityDefinitions.securitySchemes"), "type")))

        swagger.initOAuth(
        {
            usePkceWithAuthorizationCodeGrant: "{!! (bool) config('l5-swagger.defaults.ui.authorization.oauth2.use_pkce_with_authorization_code_grant') !!}",
        });

    @endif
};
</script>

</body>
</html>
