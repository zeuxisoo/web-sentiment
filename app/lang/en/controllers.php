<?php
return [
    'home' => [
        'welcome_message'  => "Welcome, :username"
    ],
    'topic' => [
        'create_success'   => "Topic created",

        'comment_success'  => "Comment saved",

        'not_topic_owner'  => "You are not the topic owner",
        'update_success'   => "Topic updated",

        'vote_success'     => "Vote success",
        'only_vote_once'   => "You have already voted for this topic",

        'report_success'   => "Report success",
        'only_report_once' => "You have already reported for this topic",

        'destroy_success'  => "Topic deleted",
    ],
    'user' => [
        'update_profile_success'  => "Profile updated",
        'update_password_success' => "Password updated",
        'password_not_match'      => "The old password doest not match exists records",
    ],
    'oauth' => [
        'access_denied'            => "Please grant access premission first",
        'token_response_exception' => "Invalid access token",
        'unknown_exception'        => "Unknown exception"
    ],
    'message' => [
        'create_success' => "Message sent",
        'unread_success' => "Mark as unread success",
        'delete_success' => "Message deleted",
    ],
    'bookmark' => [
        'only_bookmark_once' => "The topic already bookmarked",
        'bookmark_success'   => "Bookmark success",
        'not_bookmark_owner' => "You are not the bookmark owner",
        'bookmark_deleted'   => "Bookmark deleted",
    ],
    'filters'  => [
        'account_banned' => 'Account banned',
    ]
];
