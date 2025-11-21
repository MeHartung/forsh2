<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\JsonController;
use App\Model\ContactFormRequestDto;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Mailer\Transport\TransportInterface as MailerTransportInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\Exception\HttpExceptionInterface;

final class ContactController extends JsonController
{
    #[Route('/api/contact', name: 'send_contact_form', methods: 'POST')]
    public function postAccount(
        LoggerInterface  $logger,
        # MailerTransportInterface always sends the emails synchronously, even if the application uses the Messenger component!
        MailerTransportInterface  $mailer,
        #[MapRequestPayload(
            validationFailedStatusCode: Response::HTTP_BAD_REQUEST
        )] ContactFormRequestDto $contactFormRequest
    ): JsonResponse {
        try {
            $email = (new Email())
                ->from(new Address('robot@forschungsmittel.com'))
                ->to('benjamin.radermacher@forschungsmittel.com', 'jan.hangele@forschungsmittel.com')
                ->subject('Nachricht über das Kontaktformular')
                ->text(
                    <<<BODY
                    Vorname  : {$contactFormRequest->getFirstName()}
                    Nachname : {$contactFormRequest->getLastName()}
                    E-Mail   : {$contactFormRequest->getEmail()}
                    Telefon  : {$contactFormRequest->getPhone()}

                    Nachricht:
                    {$contactFormRequest->getMessage()}
                    BODY
                )
            ;

            $mailer->send($email);

            $logger->info(
                sprintf(
                    "Contact mail from %s %s (%s) successfully sent",
                    $contactFormRequest->getFirstName() ?? '',
                    $contactFormRequest->getLastName() ?? '',
                    $contactFormRequest->getEmail()
                )
            );

            return new JsonResponse();
        } catch (HttpExceptionInterface $e) {
            # TODO: We should not return any details in production! It's a 500 and that's it

            return new JsonResponse(
                ['error' => $e->getMessage()],
                $e->getCode()
            );
        } catch (\Throwable $e) {
            return new JsonResponse(
                ['error' => $e->getMessage()],
                500
            );
        }
    }
}
