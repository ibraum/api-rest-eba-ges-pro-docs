<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>API Documentation</title>
    <link rel="stylesheet" href="{{ asset('swagger-ui/swagger-ui.css') }}">
</head>
<body>
<div id="swagger-ui"></div>
<script src="{{ asset('swagger-ui/swagger-ui-bundle.js') }}"></script>
<script src="{{ asset('swagger-ui/swagger-ui-standalone-preset.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/3.52.5/swagger-ui-bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/3.52.5/swagger-ui-standalone-preset.js"></script>

<script>
    window.onload = function() {
        // Initialize Swagger UI
        const ui = SwaggerUIBundle({
            url: "openapi.json",
            dom_id: '#swagger-ui',
            presets: [
                SwaggerUIBundle.presets.apis,
                SwaggerUIStandalonePreset
            ],
            layout: "StandaloneLayout"
        });

        // Function to retrieve CSRF token
        async function getCsrfToken() {
            const response = await fetch("" + this.window.location.href);
            const data = await response.json();
            return data.remember_token;
        }

        // Inject CSRF token into requests
        ui.initOAuth({
            clientId: "your-client-id",
            clientSecret: "your-client-secret",
            scopeSeparator: " ",
            additionalQueryStringParams: {}
        });

        getCsrfToken().then(token => {
            ui.preauthorizeApiKey('CSRF', token);
        });
    };
</script>
<script>
    const ui = SwaggerUIBundle({
        url: "{{ asset('openapi.json') }}",
        dom_id: '#swagger-ui',
        deepLinking: true,
        presets: [
            SwaggerUIBundle.presets.apis,
            SwaggerUIBundle.presets.downloadUrl
        ],
        layout: "BaseLayout"
    });
</script>
</body>
</html>
