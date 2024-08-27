<?php

enum Status: string {
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
};
// Utilisation de l'énumération
$status = Status::APPROVED;

echo $status->value; // Affiche "approved"
