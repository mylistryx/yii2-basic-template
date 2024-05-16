<?php

namespace app\enums;

enum TablesEnum: string
{
    case Address = 'address';
    case City = 'city';
    case Comment = 'comment';
    case Contact = 'contact';
    case Country = 'country';
    case File = 'file';
    case Identity = 'identity';
    case IdentityProfile = 'identity_profile';
    case Post = 'post';
    case Region = 'region';
    case View = 'view';
    case Vote = 'vote';
}