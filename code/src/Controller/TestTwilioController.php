<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Twilio\Rest\Client;

class TestTwilioController extends AbstractController
{
    #[Route('/api/test-twilio', name: 'api_test_twilio')]
    public function testTwilio(Request $request): JsonResponse
    {
        // Access environment variables directly using $_ENV
        $accountSid = $_ENV['TWILIO_ACCOUNT_SID'];
        $authToken = $_ENV['TWILIO_AUTH_TOKEN'];
        $fromNumber = $_ENV['TWILIO_FROM_NUMBER']; // Twilio sandbox number

        // Get parameters from request
        $toNumber = $request->get('to', 'whatsapp:+212698351841');
        $messageType = $request->get('type', 'simple'); // 'simple' or 'template'
        $code = $request->get('code', str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT));

        try {
            $twilio = new Client($accountSid, $authToken);

            if ($messageType === 'template') {
                // Template message using ContentSid
                $message = $twilio->messages->create(
                    $toNumber,
                    [
                        'from' => $fromNumber,
                        'contentSid' => $_ENV['TWILIO_CONTENT_SID'],
                        'contentVariables' => json_encode(['1' => $code])
                    ]
                );
            } else {
                // Simple text message
                $message = $twilio->messages->create(
                    $toNumber,
                    [
                        'from' => $fromNumber,
                        'body' => "Your verification code is: $code"
                    ]
                );
            }

            return $this->json([
                'status' => 'success',
                'sid' => $message->sid,
                'to' => $toNumber,
                'type' => $messageType,
                'code' => $code,
                'timestamp' => date('c')
            ]);

        } catch (\Exception $e) {
            return $this->json([
                'status' => 'error',
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'troubleshooting' => $this->getTroubleshootingTips($e)
            ], 500);
        }
    }

    private function getTroubleshootingTips(\Exception $e): array
    {
        $tips = [];

        if (str_contains($e->getMessage(), 'not a valid WhatsApp number')) {
            $tips[] = 'Send "join [sandbox-words]" to +14155238886 from your phone';
            $tips[] = 'Verify number formatting: must be whatsapp:+212698351841';
        }

        if ($e->getCode() === 21211) {
            $tips[] = 'Invalid "To" phone number format';
        }

        if ($e->getCode() === 21608) {
            $tips[] = 'WhatsApp not enabled for your account. Upgrade in Twilio console';
        }

        return empty($tips) ? ['Check Twilio console for detailed error logs'] : $tips;
    }
}
