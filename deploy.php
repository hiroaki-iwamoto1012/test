<?php

function verify_signature($payload_body) {
    $secret_token = getenv('GITHUB_WEBHOOK_SECRET_KEY');
    $signature = 'sha256=' . hash_hmac('sha256', $payload_body, $secret_token);

    if (hash_equals($signature, $_SERVER['HTTP_X_HUB_SIGNATURE_256'])) {
        exec('./git-pull-and-npm-build.sh 2>&1', $output);
        if ($output) {
            foreach ($output as $line) {
                file_put_contents('./deploy.log', $line . "\n", FILE_APPEND);
            }
        }
    }
}

$payload_body = file_get_contents('php://input');
verify_signature($payload_body);

