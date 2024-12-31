<?php

namespace App\Shared\Infrastructure\Service;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class RequestService
{
    public static function getField(Request $request, string $fieldName, bool $isRequired = true, bool $isArray = false): mixed
    {
        $requestData = \json_decode($request->getContent(), true);

        if ($requestData === null) {
            if ($isRequired) {
                throw new \InvalidArgumentException('Invalid or empty JSON in request body.', JsonResponse::HTTP_BAD_REQUEST);
            }
            return null;
        }

        if ($isArray) {
            $arrayData = self::arrayFlatten($requestData);

            foreach ($arrayData as $key => $value) {
                if ($fieldName === $key) {
                    return $value;
                }
            }

            if ($isRequired) {
                throw new \InvalidArgumentException(\sprintf('The field %s is required!', $fieldName), JsonResponse::HTTP_BAD_REQUEST);
            }

            return null;
        }

        if (\array_key_exists($fieldName, $requestData)) {
            return $requestData[$fieldName];
        }

        if ($isRequired) {
            throw new \InvalidArgumentException(\sprintf('The field %s is required!', $fieldName), JsonResponse::HTTP_BAD_REQUEST);
        }

        return null;
    }
}
