<?php

// SPDX-FileCopyrightText: 2024 Simon Repp
// SPDX-License-Identifier: AGPL-3.0-or-later

declare(strict_types=1);

const ANONYMOUS_EDITING_USER = [
    'id' => 'anonymous_editor',
    'name' => 'Anonymous Editor',
    'permissions' => 'anonymous_editor'
];

const ANONYMOUS_VIEWING_USER = [
    'id' => 'anonymous_viewer',
    'name' => 'Anonymous Viewer',
    'permissions' => 'anonymous_viewer'
];

const DEFAULT_BOOKING_MODE = 'free';
const DEFAULT_START_OF_WEEK = 'monday';
const DEFAULT_TITLE = 'Feber';
const DEFAULT_WEEKS_SHOWN = 12;

const FEBER_VERSION = '1.1.3';

const FILENAME_EVENTS_PHP = 'events.php';
const FILENAME_LOG_PHP = 'log.php';
const FILENAME_LOG_TXT = 'log.txt';
const FILENAME_MARKERS_PHP = 'markers.php';
const FILENAME_SETTINGS_PHP = 'settings.php';

const MARKER_ICON_PATHS = [
    'm8.1455 8.1455h47.709v47.709h-47.709z',
    'm57.329 32a25.329 25.329 0 0 1-25.329 25.329 25.329 25.329 0 0 1-25.329-25.329 25.329 25.329 0 0 1 25.329-25.329 25.329 25.329 0 0 1 25.329 25.329z',
    'm32 6.6708a25.329 25.329 0 0 0-25.33 25.33 25.329 25.329 0 0 0 25.33 25.329 25.329 25.329 0 0 0 25.329-25.329 25.329 25.329 0 0 0-25.329-25.33zm0 12.664a12.665 12.665 0 0 1 12.664 12.665 12.665 12.665 0 0 1-12.664 12.664 12.665 12.665 0 0 1-12.665-12.664 12.665 12.665 0 0 1 12.665-12.665z',
    'm8.1458 8.1455v19.121h19.12v-19.121zm28.588 0v19.121h19.12v-19.121zm-28.588 28.588v19.121h19.12v-19.121zm28.588 0v19.121h19.12v-19.121z',
    'm9.5132e-5 31.999 12.825 12.825 12.824-12.824-12.825-12.825zm19.175-19.175 12.825 12.825 12.824-12.824-12.825-12.825zm-6e-6 38.35 12.825 12.825 12.824-12.824-12.825-12.825zm19.175-19.175 12.825 12.825 12.824-12.824-12.825-12.825z',
    'm8.1457 8.1458v47.708h47.708v-47.708zm11.927 11.927h23.855v23.855h-23.855z',
    'm0 32 32 32 32-32-32-32zm16 0 16-16 16 16-16 16z',
    'm18.137 6.6705-11.467 11.467 13.862 13.863-13.862 13.862 11.467 11.467 13.863-13.863 13.862 13.863 11.467-11.467-13.863-13.862 13.863-13.863-11.467-11.467-13.862 13.862z',
    'm59.712 40.108v-16.216l-19.604-6.15e-4v-19.603h-16.216v19.605l-19.604-6.15e-4v16.216l19.604-6.15e-4v19.605h16.216v-19.604z',
    'm18.137 6.6702-11.467 11.467 13.862 13.863-13.862 13.862 11.467 11.467 13.863-13.863-11.467-11.466 11.465-11.467 11.467 11.467 13.863-13.863-11.467-11.467-13.862 13.862zm25.328 25.33-11.465 11.466 13.862 13.863 11.467-11.467z',
    'm23.892 4.2873v19.605h16.216v16.216h19.604v-16.217h-19.604v-19.604zm16.216 35.821h-16.216v19.604h16.216zm-16.216-16.216-19.604-0.00123v16.217l19.604-0.0012z',
    'm9.133e-5 32 32-32 32 32-32 32z'
];

// We cap the amount of events that can be cloned in a single action
const MAX_CLONED_EVENTS = 128;

const SVG_CREATE = <<< EOD
<svg width="64" height="64" version="1.1" viewBox="0 0 64 64" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
    <title>Create</title>
    <path d="m52.17 27.502-15.678 0.02208-0.02208-15.701-8.9689 0.0068 0.02208 15.678-15.701 0.02208 0.0068 8.9689 15.678-0.02208 0.02208 15.701 8.9689-0.0068-0.02208-15.678 15.701-0.02208z"/>
</svg>
EOD;

const SVG_EXTERNAL = <<< EOD
<svg width="64" height="64" version="1.1" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
    <title>External</title>
    <path d="m55.258 55.088v-21.334h-6.2832v15.074h-33.691v-33.697h15.066v-6.2832h-21.35v46.266zm0-46.24h-20.184v6.2832h9.6582l-19.932 19.932 4.4434 4.4453 19.73-19.73v9.2793h6.2832z"/>
</svg>
EOD;

const SVG_LOGO = <<< EOD
<svg width="64" height="64" version="1.1" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
    <title>Feber</title>
    <path d="m-0.0024375-0.06v64h64v-64zm7.9294 7.9294h34.963c7.2527 0 13.178 5.925 13.178 13.178 0 4.5145-2.2965 8.5156-5.7793 10.892 3.4828 2.3773 5.7793 6.3782 5.7793 10.892v13.178h-4.5762v-13.178c0-4.7756-3.8259-8.6054-8.6018-8.6054h-10.752c2.0003 2.3124 3.2109 5.324 3.2109 8.6054 0 3.2771-1.2075 6.2806-3.2032 8.5916h9.4942v4.586h-26.318v-4.586h6.8496c4.7757 0 8.6018-3.8161 8.6018-8.5916 0-4.7756-3.8259-8.6054-8.6018-8.6054h-14.244v-4.586h14.244c4.7757 0 8.6018-3.818 8.6018-8.5938 0-4.7757-3.8259-8.6018-8.6018-8.6018h-14.244v-4.5761zm24.211 4.5761c2.0002 2.3125 3.2109 5.3202 3.2109 8.6018 0 3.2756-1.2073 6.283-3.2011 8.5938h10.742c4.7757 0 8.6018-3.818 8.6018-8.5938 0-4.7757-3.8259-8.6018-8.6018-8.6018h-10.752z" />
</svg>
EOD;

const SVG_MENU = <<< EOD
<svg width="64" height="64" version="1.1" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
    <title>Menu</title>
    <path d="m5.9219 7.1721c-0.63702 0-1.1484 0.51337-1.1484 1.1504v7.355c0 0.63702 0.51141 1.1504 1.1484 1.1504h52.156c0.63702 0 1.1484-0.51337 1.1484-1.1504v-7.355c0-0.63702-0.51141-1.1504-1.1484-1.1504z"/>
    <path d="m5.9219 27.172c-0.63702 0-1.1484 0.51337-1.1484 1.1504v7.355c0 0.63702 0.51141 1.1504 1.1484 1.1504h52.156c0.63702 0 1.1484-0.51337 1.1484-1.1504v-7.355c0-0.63702-0.51141-1.1504-1.1484-1.1504z"/>
    <path d="m5.9219 47.172c-0.63702 0-1.1484 0.51337-1.1484 1.1504v7.355c0 0.63702 0.51141 1.1504 1.1484 1.1504h52.156c0.63702 0 1.1484-0.51337 1.1484-1.1504v-7.355c0-0.63702-0.51141-1.1504-1.1484-1.1504z"/>
</svg>
EOD;

const SVG_NOTE = <<< EOD
<svg width="64" height="64" version="1.1" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
    <title>Note</title>
    <path d="m32 7.582a24.417 24.417 0 0 0-24.418 24.418v24.418h24.418a24.417 24.417 0 0 0 24.418-24.418 24.417 24.417 0 0 0-24.418-24.418zm-11.607 12.947h23.215c0.554 0 1 0.446 1 1v2.5879c0 0.554-0.446 1-1 1h-23.215c-0.554 0-1-0.446-1-1v-2.5879c0-0.554 0.446-1 1-1zm0 9.1758h23.215c0.554 0 1 0.446 1 1v2.5898c0 0.554-0.446 1-1 1h-23.215c-0.554 0-1-0.446-1-1v-2.5898c0-0.554 0.446-1 1-1zm0 9.1777h23.215c0.554 0 1 0.446 1 1v2.5879c0 0.554-0.446 1-1 1h-23.215c-0.554 0-1-0.446-1-1v-2.5879c0-0.554 0.446-1 1-1z" />
</svg>
EOD;

const SVG_REVERSE = <<< EOD
<svg width="64" height="64" version="1.1" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
    <title>Reverse time</title>
    <path d="m32 8.5254c-12.865-2.96e-4 -23.358 10.43-23.469 23.27l-3.2168-3.2168-2.8457 2.8457 5.7207 5.7207 2.8457 2.8477 2.8457-2.8477 5.7227-5.7207-2.8457-2.8457-2.8945 2.8945c0.27752-9.8092 8.258-17.623 18.137-17.623 10.055 7.13e-4 18.149 8.0955 18.148 18.15 2.29e-4 10.055-8.0936 18.15-18.148 18.15-5.0278 1.15e-4 -9.565-2.024-12.846-5.3047l-3.7422 3.7422c4.252 4.252 10.121 6.8869 16.588 6.8867 12.933-9.16e-4 23.473-10.542 23.473-23.475 2.98e-4 -12.933-10.54-23.474-23.473-23.475zm-2.0137 10.529v13.791l7.1582 7.1465 2.8457-2.8477-5.9785-5.9766v-12.113h-4.0254z"/>
</svg>
EOD;

// ***************************************************
// * From here on we're first defining functions,    *
// * which we only use later on in the program flow. *
// ***************************************************

// Returns the first day shown in the calendar (based
// on the start_of_week calendar setting).
function get_first_day_in_calendar(array $settings): string {
    $week_start_offset = get_week_start_day_offset($settings);

    $first_day_offset = $week_start_offset;
    $first_day_date = strtotime($first_day_offset . ' days');
    $first_day_iso = date('Y-m-d', $first_day_date);

    return $first_day_iso;
}

// Returns the first and last day shown in the calendar (based
// on calendar settings start_of_week and weeks_shown).
function get_last_day_in_calendar(array $settings): string {
    $week_start_offset = get_week_start_day_offset($settings);

    $last_day_offset = $week_start_offset + $settings['weeks_shown'] * 7 - 1;
    $last_day_date = strtotime($last_day_offset . ' days');
    $last_day_iso = date('Y-m-d', $last_day_date);

    return $last_day_iso;
}

// Loads persisted events from file and returns the one with the given id (if exists)
function get_event(string $id): ?array {
    if (file_exists(FILENAME_EVENTS_PHP)) {
        include FILENAME_EVENTS_PHP;

        foreach($events as &$event) {
            if ($event['id'] === $id) {
                return $event;
            }
        }
    }
    
    return null;
}

function get_event_owner(array $users, string $owner_id): ?array {
    if ($owner_id === 'anonymous_editor') {
        return ANONYMOUS_EDITING_USER;
    }

    foreach ($users as $user) {
        if ($user['id'] === $owner_id) {
            return $user;
        }
    }

    return [
        'id' => $owner_id,
        'name' => 'Former user',
        'permissions' => ''
    ];
}

// Load persisted events from the filesystem
function get_events(): array {
    if (file_exists(FILENAME_EVENTS_PHP)) {
        include FILENAME_EVENTS_PHP;
        return $events;
    }
    
    return [];
}

function get_marker(int $index): array {
    $period = count(MARKER_ICON_PATHS);
    $repetition_fractional = $index / $period; 
    $repetition = floor($repetition_fractional);

    $icon = MARKER_ICON_PATHS[$index % $period];

    $icon_hue_offset = $repetition_fractional - $repetition;

    if ($repetition == 0) {
        return [
            'hue' => $icon_hue_offset * 360,
            'path' => $icon 
        ];
    }

    $power = floor(log($repetition, 2));
    $divisions = pow(2, $power);

    $offset = 0.5 / $divisions;
    $step = $repetition % $divisions;
    $division_width = 1 / $divisions;
    $repetition_hue_offset = $offset + $step * $division_width;

    return [
        'hue' => ($icon_hue_offset + $repetition_hue_offset) * 360,
        'path' => $icon 
    ];
}

function get_marker_icon($id, $hue, $path): string {
    if ($hue === null) {
        $color = "var(--muted)";
        $color2 = "var(--muted)";
    } else {
        $hue2 = $hue + 30;
        $color = "hsl({$hue}deg, 100%, var(--event-l))";
        $color2 = "hsl({$hue2}deg, 100%, var(--event-l))";
    }

    return <<< EOD
        <svg class="dot" width="64" height="64" version="1.1" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <linearGradient id="gradient_{$id}" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color: {$color};" />
                    <stop offset="100%" style="stop-color: {$color2};" />
                </linearGradient>
            </defs>
            <path d="{$path}" fill="url(#gradient_{$id})"/>
        </svg>
    EOD;
}

// Load persisted markers from the filesystem
function get_markers(): array {
    if (file_exists(FILENAME_MARKERS_PHP)) {
        include FILENAME_MARKERS_PHP;
        return $markers;
    }
    
    return [];
}

// Returns "how many days ago the week started" based on the
// start_of_week calendar setting. E.g. if the week starts
// on monday and today it's wednesday, the returned day offset
// is -2.
function get_week_start_day_offset(array $settings): int {
    if ($settings['start_of_week'] === 'sunday') {
        return date('w') * -1;
    } else /* if ($settings['start_of_week'] === 'monday') */ {
        return ((date('w') + 6) % 7) * -1;
    }
}

function has_create_permission(array $user): bool {
    return $user['permissions'] === 'admin' ||
           $user['permissions'] === 'anonymous_editor' ||
           $user['permissions'] === 'editor' ||
           $user['permissions'] === 'organizer';
}

// Anonymous editors can not delete events because their ownership
// of events can never be determined.
function has_delete_permission(array $user): bool {
    return $user['permissions'] === 'admin' ||
           $user['permissions'] === 'editor' ||
           $user['permissions'] === 'organizer';
}

// Checks if the passed string is a valid int
function is_valid_int(string $int): bool {
    return preg_match('/^\d+$/', $int) === 1;
}

// Checks if the passed string is a valid date in the format YYYY-MM-DD
function is_valid_date(string $date): bool {
    return DateTimeImmutable::createFromFormat('Y-m-d', $date) !== false;
}

// Checks if the passed string is a valid permissions specification
// (Note that there are also anonymous editor/viewer permissions but
//  these are only handled internally and never provided by user)
function is_valid_permissions(string $permissions): bool {
    return $permissions === 'admin' ||
           $permissions === 'editor' ||
           $permissions === 'organizer' ||
           $permissions === 'viewer';
}

// Checks if the passed string is a valid time between 00:00 and 23:59
function is_valid_time(string $time): bool {
    return preg_match('/^(?:[0-1][0-9]|2[0-3]):[0-5][0-9]$/', $time) === 1;
}

// Checks if the passed string is a valid username (contains no whitespace)
function is_valid_username(string $username): bool {
    return preg_match('/^\S+$/', $username) === 1;
}

// Logs message in the format "// [ISO Datetime] [Message]" to log.php
function log_line(string $message) {
    $logtime_iso = date('c');
    $log_line = "// {$logtime_iso} {$message}" . PHP_EOL;
    file_put_contents(FILENAME_LOG_PHP, $log_line, FILE_APPEND | LOCK_EX);
}

// Writes the passed events to events.php
function persist_events(array $events) {
    $events_php = "<?php\n\n";
    $events_php .= "\$events = [\n";
    
    foreach ($events as $index => $event) {
        $separator = ($index !== count($events) - 1) ? ',' : '';

        $events_php .= "    [\n";
        $events_php .= "        'date' => '{$event['date']}',\n";
        $events_php .= "        'from' => '{$event['from']}',\n";
        $events_php .= "        'id' => '{$event['id']}',\n";

        if (isset($event['note'])) {
            $note_escaped = addcslashes(addslashes($event['note']), "\n");
            $events_php .= "        'note' => '{$note_escaped}',\n";
        }

        $events_php .= "        'owner_id' => '{$event['owner_id']}',\n";

        if (isset($event['title'])) {
            $title_escaped = addslashes($event['title']);
            $events_php .= "        'title' => '{$title_escaped}',\n";
        }

        $events_php .= "        'to' => '{$event['to']}'\n";
        $events_php .= "    ]{$separator}\n";
    }

    $events_php .= "];\n";

    file_put_contents(FILENAME_EVENTS_PHP, $events_php);
    opcache_invalidate(FILENAME_EVENTS_PHP, true);
}

// Writes the passed markers to markers.php
function persist_markers(array $markers) {
    $markers_php = "<?php\n\n";
    $markers_php .= "\$markers = [\n";
    
    $index = 0;
    foreach ($markers as $key => $seed) {
        $key_escaped = addslashes($key);
        $separator = ($index !== count($markers) - 1) ? ',' : '';
        $markers_php .= "    '{$key_escaped}' => {$seed}{$separator}\n";
        $index++;
    }

    $markers_php .= "];\n";

    file_put_contents(FILENAME_MARKERS_PHP, $markers_php);
    opcache_invalidate(FILENAME_MARKERS_PHP, true);
}

// Writes the passed settings to settings.php
function persist_settings(array $settings) {
    $title_escaped = addslashes($settings['title']);

    $settings_php = "<?php\n\n";
    $settings_php .= "\$settings = [\n";

    if (isset($settings['anonymous_editing_key'])) {
        $settings_php .= "    'anonymous_editing_key' => '{$settings['anonymous_editing_key']}',\n";
    }

    if (isset($settings['anonymous_viewing_key'])) {
        $settings_php .= "    'anonymous_viewing_key' => '{$settings['anonymous_viewing_key']}',\n";
    }

    $settings_php .= "    'booking_mode' => '{$settings['booking_mode']}',\n";

    if (isset($settings['ics_key'])) {
        $settings_php .= "    'ics_key' => '{$settings['ics_key']}',\n";
    }

    $settings_php .= "    'start_of_week' => '{$settings['start_of_week']}',\n";
    $settings_php .= "    'title' => '{$title_escaped}',\n";
    $settings_php .= "    'users' => [\n";

    foreach ($settings['users'] as $index => $user) {
        $password_hash_escaped = addslashes($user['password_hash']);
        $name_escaped = addslashes($user['name']);
        $separator = ($index !== count($settings['users']) - 1) ? ',' : '';
        $username_escaped = addslashes($user['username']);

        $settings_php .= "        [\n";
        $settings_php .= "            'id' => '{$user['id']}',\n";
        $settings_php .= "            'password_hash' => '{$password_hash_escaped}',\n";
        $settings_php .= "            'name' => '{$name_escaped}',\n";
        $settings_php .= "            'permissions' => '{$user['permissions']}',\n";
        $settings_php .= "            'username' => '{$username_escaped}'\n";
        $settings_php .= "        ]{$separator}\n";
    }

    $settings_php .= "    ],\n";
    $settings_php .= "    'weeks_shown' => {$settings['weeks_shown']}\n";
    $settings_php .= "];\n";

    file_put_contents(FILENAME_SETTINGS_PHP, $settings_php);
    opcache_invalidate(FILENAME_SETTINGS_PHP, true);
}

// Returns a 10 character long id like 'caced1ad17' (0-9a-f)
function random_id(): string {
    return bin2hex(random_bytes(5));
}

function render_calendar(array $active_user, array $events, array $markers, array $settings) {
    render_layout_begin($settings['title']);

    $svg_create = SVG_CREATE;
    $svg_reverse = SVG_REVERSE;

    if (isset($_SESSION['reverse'])) {
        echo <<< EOD
            <div class="reverse_overlay">
                <span>
                    Time is reversed<br>
                    Click {$svg_reverse} to reset<br>
                </span>
            </div>
        EOD;
    }

    echo '<div class="calendar_split"><div class="calendar_wrapper">';

    render_header($active_user, $settings);

    echo "<div class=\"calendar\">";

    $week_start_offset = get_week_start_day_offset($settings);

    $today_iso = date('Y-m-d');

    $empty_collection = null;

    // Render calendar cells
    for ($week_offset = 0; $week_offset < $settings['weeks_shown']; $week_offset++) {
        for ($day_offset = 0; $day_offset < 7; $day_offset++) {
            $extra_classes = '';

            if (isset($_SESSION['reverse'])) {
                // In reverse mode we iterate weeks negatively, and days in reverse order
                $summed_offset = $week_start_offset + ($week_offset * 7 * -1) + (6 - $day_offset);
                $extra_classes = ' order-' . (7 - $day_offset);

                if ($summed_offset > 0) {
                    $extra_classes .= ' clip';
                }
            } else {
                $summed_offset = $week_start_offset + ($week_offset * 7) + $day_offset;

                if ($summed_offset < 0) {
                    $extra_classes .= ' clip';
                }
            }

            if ($summed_offset < 0) {
                $extra_classes .= ' past';
            }

            $date_raw = strtotime($summed_offset.' days');
            $date_iso = date('Y-m-d', $date_raw);
    
            $month_numeric = (int)date('n', $date_raw);
            if ($month_numeric % 2 === 1) {
                $extra_classes .= ' odd';
            }

            if ($date_iso === $today_iso) {
                $extra_classes .= ' today';
            }

            $day_of_month = date('j', $date_raw);
            $month_name_abbreviated = date('M', $date_raw);
            if ($day_of_month === '1' || ($week_offset === 0 && (isset($_SESSION['reverse']) ? $day_offset === 6 : $day_offset === 0))) {
                $month_name_full = date('F', $date_raw);

                $label_narrow = "<strong>{$month_name_abbreviated} {$day_of_month}</strong>";
                $label_wide = "<strong>{$month_name_full} {$day_of_month}</strong>";
            } else {
                $label_narrow = "<strong>{$day_of_month}</strong>";
                $label_wide = "<strong>{$day_of_month}</strong>";
            }

            $label_mobile = "<strong>{$month_name_abbreviated} {$day_of_month}</strong>";

            if ($date_iso === $today_iso) {
                $label_mobile = "{$label_mobile} <span class=\"addendum\">Today</span>";
                $label_narrow = "{$label_narrow} <span class=\"addendum\">Today</span>";
                $label_wide = "{$label_wide} <span class=\"addendum\">Today</span>";
            } else if ($week_offset === 0) {
                $day_of_week_abbreviated = date('D', $date_raw);
                $day_of_week_full = date('l', $date_raw);
                $label_narrow = "{$label_narrow} <span class=\"addendum\">{$day_of_week_abbreviated}</span>";
                $label_wide = "{$label_wide} <span class=\"addendum\">{$day_of_week_full}</span>";
            }

            $label_title = date('l F j Y', $date_raw);

            $event_links = '';

            foreach ($events as $event) {
                if ($event['date'] !== $date_iso) continue;

                $event_owner = get_event_owner($settings['users'], $event['owner_id']);
                $title = isset($event['title']) ? $event['title'] : $event_owner['name'];
                $title_escaped = htmlspecialchars($title);
                $note_icon = isset($event['note']) ? SVG_NOTE : '';

                if (substr($event['from'], 3, 5) === "00" && substr($event['to'], 3, 5) === "00") {
                    $from_hour = substr($event['from'], 0, 2);
                    $to_hour = substr($event['to'], 0, 2);
                    $timeframe = "{$from_hour}<wbr>-<wbr>{$to_hour}";
                } else {
                    $timeframe = "{$event['from']}<wbr>-<wbr>{$event['to']}";
                }

                $marker = get_marker($markers[$title]);
                $marker_icon = get_marker_icon($event['id'], $date_iso < $today_iso ? null : $marker['hue'], $marker['path']);

                $event_links .= <<< EOD
                    <div class="event_wrapper">
                        <a class="event"
                            data-id="{$event['id']}"
                            href="?event={$event['id']}"
                            title="{$event['from']}-{$event['to']} {$title_escaped} ({$event_owner['name']})">
                            {$marker_icon}{$note_icon}<span>{$timeframe} {$title_escaped}</span>
                        </a>
                    </div>
                EOD;                            
            }

            // TODO: empty_collection procesing is not yet working well with today having to be rendered anyway
            if ($event_links === '') {
                if ((!isset($_SESSION['reverse']) && $date_iso > $today_iso) ||
                    (isset($_SESSION['reverse']) && $date_iso < $today_iso)) {
                    if ($empty_collection === null) {
                        $empty_collection = [ 'from' => $date_raw ];
                    }
                    
                    $empty_collection['to'] = $date_raw;
                }

                if ($date_iso !== $today_iso) {
                    $extra_classes .= ' clip_empty';
                }
                $empty_collection_rendered = '';
                $empty_text = '<span class="empty_text">No events</span>';
            } else {
                if ($empty_collection === null) {
                    $empty_collection_rendered = '';
                } else {
                    $from_day_of_month = date('j', $empty_collection['from']);
                    $from_month_name_abbreviated = date('M', $empty_collection['from']);
                    $from_label = "{$from_month_name_abbreviated} {$from_day_of_month}";

                    if ($empty_collection['to'] !== $empty_collection['from']) {
                        $to_day_of_month = date('j', $empty_collection['to']);
                        $to_month_name_abbreviated = date('M', $empty_collection['to']);
                        $to_label = " … {$to_month_name_abbreviated} {$to_day_of_month}";
                    } else {
                        $to_label = '';
                    }

                    $from_month_numeric = (int)date('n', $empty_collection['from']);
                    if ($from_month_numeric % 2 === 1) {
                        $from_extra_classes = ' odd';
                    } else {
                        $from_extra_classes = '';
                    }

                    $empty_collection_rendered = <<< EOD
                        <div class="empty_collection {$from_extra_classes}">
                            <span class="timeframe">{$from_label}{$to_label}</span>
                            <span>No events</span>
                        </div>
                    EOD;
                    $empty_collection = null;
                }

                $empty_text = '';
            }

            if (has_create_permission($active_user) && $date_iso >= $today_iso) {
                $create_link = "<a class=\"create_inline\" href=\"?create&date={$date_iso}\">+</a>";
            } else {
                $create_link = '';
            }

            echo <<< EOD
                {$empty_collection_rendered}
                <div class="date{$extra_classes}">
                    <div class="label" title="{$label_title}">
                        <span class="mobile">{$label_mobile}</span>
                        <span class="narrow">{$label_narrow}</span>
                        <span class="wide">{$label_wide}</span>
                    </div>
                    {$event_links}
                    {$empty_text}
                    {$create_link}
                </div>
            EOD;
        }
    }

    echo '</div>'; // Ends .calendar
    echo '</div>'; // Ends .calendar_wrapper

    if (has_create_permission($active_user)) {
        $create_link = <<< EOD
            <a class="create tool" href="?create">
                {$svg_create}
            </a>
        EOD;
        $raised = ' raised';
    } else {
        $create_link = '';
        $raised = '';
    }

    echo <<< EOD
        <div class="tools_wrapper">
            {$create_link}
            <a class="reverse tool{$raised}" href="?reverse">
                {$svg_reverse}
            </a>
            <div class="tooltip">JavaScript is disabled, keyboard shorcut tools are not available.</div>
        </div>
    EOD;

    echo '</div>'; // Ends .calendar_split

    render_layout_end();
}

function render_create(array $active_user, string $date, array $settings) {
    render_layout_begin('Create');
    render_header($active_user, $settings);

    $today_iso = date('Y-m-d');
    $last_day_in_calendar = get_last_day_in_calendar($settings);

    if ($settings['booking_mode'] === 'free') {
        $title_field = <<< EOD
            <div class="form_row">
                <label for="title">Title</label>
                <input
                    id="title"
                    name="title"
                    type="text">
                <span class="dimmed">If left blank, your name will be shown as title.</span>
            </div>
        EOD;
    } else /* if ($settings['booking_mode'] === 'name') */ {
        $name_escaped = htmlspecialchars($active_user['name']);
        $title_field = <<< EOD
            <div class="form_row">
                <label class="dimmed" for="title">Title (automatic)</label>
                <input
                    disabled
                    id="title"
                    name="title"
                    type="text"
                    value="{$name_escaped}">
                <span class="dimmed">
                    This calendar uses name-based booking - bookings are automatically
                    labelled with the name of their owner, no title is required.
                </span>
            </div>
        EOD;
    }

    echo <<< EOD
        <div class="page">
            <form action="?create" method="post">
                <div class="create_inner">
                    <h1>Create event</h1>
                    <div class="form_row">
                        <label for="date">Date *</label>
                        <input
                            id="date"
                            max="{$last_day_in_calendar}"
                            min="{$today_iso}"
                            name="date"
                            required
                            type="date"
                            value="{$date}">
                    </div>
                    <div class="form_row">
                        <label for="from">From *</label>
                        <input
                            id="from"
                            name="from"
                            required
                            type="time">
                    </div>
                    <div class="form_row">
                        <label for="to">To *</label>
                        <input
                            id="to"
                            name="to"
                            required
                            type="time">
                    </div>
                    {$title_field}
                    <div class="form_row">
                        <label for="note">Note</label>
                        <textarea id="note" name="note"></textarea>
                    </div>
                    <div class="form_row">
                        <label for="repeats">Repeats</label>
                        <select id="repeats" name="repeats">
                            <option value="never">Never</option>
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="biweekly">Biweekly</option>
                        </select>
                    </div>
                    <div class="form_row">
                        <label for="until">Repeat until</label>
                        <input
                            id="until"
                            max="{$last_day_in_calendar}"
                            min="{$today_iso}"
                            name="until"
                            type="date">
                    </div>
                    <div class="form_row form_spaced">
                        <span></span>
                        <div>
                            <button name="submit">Create</button>
                            <a class="button cancel" href="./">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    EOD;

    render_layout_end();
}

function render_event(array $active_user, array $event, array $settings) {
    render_layout_begin($settings['title']);
    render_header($active_user, $settings);

    $note_escaped = isset($event['note']) ? htmlspecialchars($event['note']) : '';
    $title_escaped = isset($event['title']) ? htmlspecialchars($event['title']) : '';

    $today_iso = date('Y-m-d');
    $last_day_in_calendar = get_last_day_in_calendar($settings);

    if (
        $event['date'] >= $today_iso &&
        (
            $active_user['permissions'] === 'admin' ||
            $active_user['permissions'] === 'editor' ||
            ($active_user['permissions'] === 'organizer' && $active_user['id'] === $event['owner_id'])
        )
    ) {
        if ($active_user['permissions'] === 'admin' ||
            $active_user['permissions'] === 'editor') {
            $options = '';
            $orphaned = true;

            if ($event['owner_id'] === 'anonymous_editor') {
                $options = "<option selected value=\"anonymous_editor\">Anonymous Editor</option>\n{$options}";
                $orphaned = false;
            }

            foreach ($settings['users'] as $user) {
                if ($user['id'] === $event['owner_id']) {
                    $orphaned = false;
                    $selected = ' selected';
                } else {
                    $selected = '';
                }

                $name_escaped = htmlspecialchars($user['name']);
                $username_escaped = htmlspecialchars($user['username']);
                $options .= <<< EOD
                    <option{$selected} value="{$user['id']}">{$name_escaped} ({$username_escaped})</option>
                EOD;
            }

            if ($orphaned) {
                $options = "<option selected value=\"\">Former user (orphaned)</option>\n{$options}";
            }

            $owner_select = <<< EOD
                <div class="form_row">
                    <label for="owner">Owner *</label>
                    <select
                        id="owner"
                        name="owner_id"
                        type="owner"
                        value="{$event['owner_id']}">
                        {$options}
                    </select>
                </div>
            EOD;
        } else {
            $owner_select = '';
        }

        if ($settings['booking_mode'] === 'free' || isset($event['title'])) {
            $title_field = <<< EOD
                <div class="form_row">
                    <label for="title">Title</label>
                    <input
                        id="title"
                        name="title"
                        type="text"
                        value="{$title_escaped}">
                    <span class="dimmed">If left blank, your name will be shown as title.</span>
                </div>
            EOD;
        } else /* if ($settings['booking_mode'] === 'name') */ {
            $name_escaped = htmlspecialchars($active_user['name']);
            $title_field = <<< EOD
                <div class="form_row">
                    <label class="dimmed" for="title">Title (automatic)</label>
                    <input
                        disabled
                        id="title"
                        name="title"
                        type="text"
                        value="{$name_escaped}">
                    <span class="dimmed">
                        This calendar uses name-based booking - bookings are automatically
                        labelled with the name of their owner, no title is required.
                    </span>
                </div>
            EOD;
        }

        $edit_form = <<< EOD
            <form action="?event={$event['id']}" method="post">
                <div class="create_inner">
                    <h2>Edit event</h2>
                    {$owner_select}
                    <div class="form_row">
                        <label for="date">Date *</label>
                        <input
                            id="date"
                            max="{$last_day_in_calendar}"
                            min="{$today_iso}"
                            name="date"
                            required
                            type="date"
                            value="{$event['date']}">
                    </div>
                    <div class="form_row">
                        <label for="from">From *</label>
                        <input
                            id="from"
                            name="from"
                            required
                            type="time"
                            value="{$event['from']}">
                    </div>
                    <div class="form_row">
                        <label for="to">To *</label>
                        <input
                            id="to"
                            name="to"
                            required
                            type="time"
                            value="{$event['to']}">
                    </div>
                    {$title_field}
                    <div class="form_row">
                        <label for="note">Note</label>
                        <textarea id="note" name="note">{$note_escaped}</textarea>
                    </div>
                    <div class="form_row form_spaced">
                        <span></span>
                        <div>
                            <button name="save">Save</button>
                            <a class="button cancel" href="./">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
            <form action="?delete" method="post" onsubmit="return confirm('Really delete event?');">
                <div class="create_inner">
                    <h2>Delete event</h2>
                    <input name="ids[]" type="hidden" value="{$event['id']}">
                    <div class="form_row form_spaced">
                        <span></span>
                        <div>
                            <button>Delete</button>
                        </div>
                    </div>
                </div>
            </form>
        EOD;
    } else {
        $edit_form = '';
    }

    $date_human_full = date('l F j Y', strtotime($event['date']));

    $event_owner = get_event_owner($settings['users'], $event['owner_id']);

    $title_or_owner_escaped = isset($event['title']) ? $title_escaped : htmlspecialchars($event_owner['name']);

    echo <<< EOD
        <div class="page">
            <h1>{$title_or_owner_escaped}</h1>
            <p>
                {$event_owner['name']}<br>
                {$date_human_full}<br>
                {$event['from']}-{$event['to']}<br>
                {$note_escaped}
            </p>
            <p>
                <a href="./">Back to calendar</a>
            </p>
            {$edit_form}
        </div>
    EOD;

    render_layout_end();
}

function render_header(array $active_user, array $settings) {
    $feber_version = FEBER_VERSION;
    $svg_create = SVG_CREATE;
    $svg_external = SVG_EXTERNAL;
    $svg_logo = SVG_LOGO;
    $svg_reverse = SVG_REVERSE;
    $svg_menu = SVG_MENU;

    $name_escaped = htmlspecialchars($active_user['name']);

    if ($active_user['id'] === 'anonymous_editor' || $active_user['id'] === 'anonymous_viewer') {
        $user_link = "<span>$name_escaped</span>";
    } else {
        $user_active = isset($_GET['user']) ? ' class="active"' : '';
        $user_link = "<a{$user_active} href=\"?user={$active_user['id']}\">$name_escaped</a>";
    }

    if ($active_user['permissions'] === 'admin') {
        $settings_active = isset($_GET['settings']) ? ' class="active"' : '';
        $users_active = isset($_GET['users']) ? ' class="active"' : '';
        $admin_links = <<< EOD
            <a{$settings_active} href="?settings">Edit calendar</a>
            <a{$users_active} href="?users">Edit users</a>
        EOD;
    } else {
        $admin_links = '';
    }

    if (has_create_permission($active_user)) {
        $create_instruction = "<li>Click {$svg_create} to create events</li>";
    } else {
        $create_instruction = '';
    }

    $shortcuts_active = isset($_GET['shortcuts']) ? ' class="active"' : '';

    echo <<< EOD
        <dialog class="splash_wrapper">
            <div class="splash">
                <img src="splash.jpg?{$feber_version}">
                <div class="pad">
                    <ul autofocus>
                        {$create_instruction}
                        <li>Click {$svg_reverse} to see past events</li>
                        <li>Click {$svg_menu} to open the menu</li>
                    </ul>
                    <div class="hsplit">
                        <a href="https://simonrepp.com/feber" target="_blank">
                            {$svg_external}
                            <span>Feber {$feber_version}</span>
                        </a>
                        <form method="dialog">
                            <button autofocus>Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </dialog>
        <header>
            <a class="title" href="./">
                {$svg_logo}
                <span>{$settings['title']}</span>
            </a>
            <div>
                <button aria-controls="menu" aria-expanded="false" aria-label="Menu" id="menu_button">
                    {$svg_menu}
                </button>
                <nav class="menu" id="menu">
                    {$user_link}
                    {$admin_links}
                    <a{$shortcuts_active} href="?shortcuts">Shortcuts</a>
                    <a href="#about">About Feber</a>
                    <a href="?logout">Sign out</a>
                </nav>
            </div>
        </header>
    EOD;
}

// References:
// - https://icalendar.org/RFC-Specifications/iCalendar-RFC-5545/
// - https://www.kanzaki.com/docs/ical/
// - https://www.ietf.org/rfc/rfc2445.txt
function render_ics(array $events, array $settings) {
    $feber_version = FEBER_VERSION;

    $request_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $owner_identifier = substr($_SERVER['SERVER_NAME'] . $request_path, 0, -1);
    $text_identifier = "NONSGML Feber {$feber_version}";

    echo "BEGIN:VCALENDAR\n";
    echo "VERSION:2.0\n";
    echo "NAME:{$settings['title']}\n";
    echo "PRODID:-//{$owner_identifier}//{$text_identifier}//EN\n";

    // Break long lines into multiple lines (see https://icalendar.org/iCalendar-RFC-5545/3-1-content-lines.html)
    function echo_folded_line_with_newline(string $line) {
        // We use strlen because the spec asks for lines to not exceed 75 octets (=bytes),
        // and we use mb_strcut because we do not want to cut through the middle of a
        // multi-byte character (see https://www.php.net/manual/en/function.mb-strcut.php).
        while (strlen($line) > 75) {
            echo mb_strcut($line, 0, 75) . "\n";
            $line = ' ' . mb_strcut($line, 75);
        }

        echo $line . "\n";
    }

    // Format as "YYYYMMDD" - see https://icalendar.org/iCalendar-RFC-5545/3-3-5-date-time.html
    function ical_date(string $date) {
        return substr($date, 0, 4) . substr($date, 5, 2) . substr($date, 8, 2);
    }

    // Format as "hhmm" - see https://icalendar.org/iCalendar-RFC-5545/3-3-5-date-time.html
    function ical_time(string $time) {
        return substr($time, 0, 2) . substr($time, 3, 2) . '00';
    }

    $dtstamp = date('Ymd') . 'T' . date('His') . 'Z';

    foreach ($events as $event) {
        echo "BEGIN:VEVENT\n";
        echo "UID:{$event['id']}\n";
        echo "DTSTAMP:{$dtstamp}\n";

        $date = ical_date($event['date']);
        $from = ical_time($event['from']);
        $to = ical_time($event['to']);

        echo "DTSTART:{$date}T{$from}\n";
        echo "DTEND:{$date}T{$to}\n";

        $event_owner = get_event_owner($settings['users'], $event['owner_id']);

        if (isset($event['title'])) {
            $title = $event['title'];
        } else {
            $title = $event_owner['name'];
        }

        echo_folded_line_with_newline("SUMMARY:{$title}");

        if (isset($event['note'])) {
            echo_folded_line_with_newline("COMMENT:{$event['note']}");
        }

        echo "END:VEVENT\n";
    }

    echo "END:VCALENDAR";
}

function render_layout_begin(string $title) {
    $feber_version = FEBER_VERSION;
    echo <<< EOD
        <!DOCTYPE html>
        <html>
            <head>
                <title>{$title}</title>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link href="favicon.svg" rel="icon" type="image/svg+xml">
                <link rel="stylesheet" href="styles.css?{$feber_version}">
                <script defer src="scripts.js?{$feber_version}"></script>
            </head>
            <body data-version="{$feber_version}">
                <script>document.body.classList.add('js_enabled');</script>
    EOD;
}

function render_layout_end() {
    echo <<< EOD
            </body>
        </html>
    EOD;
}

function render_login(array $settings, string $error = null) {
    render_layout_begin($settings['title']);

    $error_rendered = $error === null ? '' : "<div class=\"error\">$error</div>";
    $svg_logo = SVG_LOGO;
    $feber_version = FEBER_VERSION;

    echo <<< EOD
        <div class="center">
            <div class="pad">
                <h1 class="login">{$svg_logo} {$settings['title']}</h1>
                <form action="?login" method="post">
                    {$error_rendered}
                    <div class="form_row">
                        <label for="username">Username</label>
                        <input autofocus
                               id="username"
                               name="username"
                               pattern="[^\s]+"
                               required
                               style="max-width: 14rem;">
                    <div class="form_row">
                        <label for="password">Password</label>
                        <input id="password"
                               name="password"
                               required
                               style="max-width: 14rem;"
                               type="password">
                    </div>
                    <div class="form_spaced">
                        <button>Sign in</button>
                    </div>
                </form>
            </div>
        </div>
    EOD;

    render_layout_end();
}

function render_settings(array $active_user, array $settings) {
    render_layout_begin('Settings');
    render_header($active_user, $settings);

    $title_escaped = htmlspecialchars($settings['title']);

    $monday_selected = $settings['start_of_week'] === 'monday' ? ' selected' : '';
    $sunday_selected = $settings['start_of_week'] === 'sunday' ? ' selected' : '';

    $name_mode_checked = $settings['booking_mode'] === 'name' ? ' checked' : '';
    $free_mode_checked = $settings['booking_mode'] === 'free' ? ' checked' : '';

    echo '<div class="page">';

    echo <<< EOD
        <form action="?settings" method="post">
            <h1>Calendar</h1>
            <div class="form_row form_spaced margin_top">
                <label for="title">Title</label>
                <input
                    id="title"
                    name="title"
                    required
                    type="text"
                    value="{$title_escaped}">
            </div>
            <div class="form_row form_spaced margin_top">
                <label for="start_of_week">Start of week</label>
                <select id="start_of_week" name="start_of_week">
                    <option{$sunday_selected} value="sunday">Sunday</option>
                    <option{$monday_selected} value="monday">Monday</option>
                </select>
            </div>
            <div class="form_row form_spaced margin_top">
                <label for="weeks_shown">Weeks shown</label>
                <input
                    id="weeks_shown"
                    name="weeks_shown"
                    min="2"
                    max="260"
                    required
                    type="number"
                    value="{$settings['weeks_shown']}">
                <span class="dimmed">
                    Defines the date range of the calendar for everyone.
                    Events can only be created and seen between the current day and the
                    amount of weeks in the future (and past) that is defined here.
                </span>
            </div>
            <fieldset class="margin_top">
                <legend>Booking mode</legend>
                <div class="form_row form_spaced">
                    <div>
                        <input
                            {$free_mode_checked}
                            id="booking_mode_free"
                            name="booking_mode"
                            required
                            type="radio"
                            value="free">
                        <label for="booking_mode_free">Freely titled booking</label>
                    </div>
                    <span class="dimmed">
                        Freely titled booking allows users to pick arbitrary titles
                        for events. This makes sense for more complex settings, where
                        events might be labelled "Presentation by Alice in Room B" or
                        such. Note that there is also a note field for events, so not
                        all information needs to be put in the title if not strictly
                        needed there.
                    </span>
                </div>
                <div class="form_row form_spaced">
                    <div>
                        <input
                            {$name_mode_checked}
                            id="booking_mode_name"
                            name="booking_mode"
                            required
                            type="radio"
                            value="name">
                        <label for="booking_mode_name">Name-based booking</label>
                    </div>
                    <span class="dimmed">
                        Name-based booking is a simpler booking mode where every booking
                        gets their title from the name of the person that booked the event.
                        This mode is beneficial if you're organizing rental of a single
                        resource, such as a shared bike or a rehearsal room.
                    </span>
                </div>
            </fieldset>
            <div class="form_row form_spaced margin_top">
                <span></span>
                <div>
                    <button name="save_settings">Save</button>
                    <a class="button cancel" href="./">Cancel</a>
                </div>
            </div>
        </form>
    EOD;

    echo '<h2>ical/ics subscription link</h2>';
    if (isset($settings['ics_key'])) {
        $request_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        echo <<< EOD
            <input disabled type="text" style="width: 32rem;" value="https://{$_SERVER['HTTP_HOST']}{$request_path}?ics={$settings['ics_key']}">
            <form action="?settings" method="post">
                <div class="form_row form_spaced">
                    <span></span>
                    <div>
                        <button name="toggle_ical_subscription">Disable</button>
                    </div>
                </div>
            </form>
        EOD;
    } else {
        echo <<< EOD
            <form action="?settings" method="post">
                <div class="form_row form_spaced">
                    <span></span>
                    <div>
                        <button name="toggle_ical_subscription">Enable</button>
                    </div>
                </div>
            </form>
        EOD;
    }

    echo '<h2>Anonymous viewing link</h2>';
    if (isset($settings['anonymous_viewing_key'])) {
        $request_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        echo <<< EOD
            <input disabled type="text" style="width: 32rem;" value="https://{$_SERVER['HTTP_HOST']}{$request_path}?key={$settings['anonymous_viewing_key']}">
            <form action="?settings" method="post">
                <div class="form_row form_spaced">
                    <span></span>
                    <div>
                        <button name="toggle_anonymous_viewing">Disable</button>
                    </div>
                </div>
            </form>
        EOD;
    } else {
        echo <<< EOD
            <form action="?settings" method="post">
                <div class="form_row form_spaced">
                    <span></span>
                    <div>
                        <button name="toggle_anonymous_viewing">Enable</button>
                    </div>
                </div>
            </form>
        EOD;
    }

    echo '<h2>Anonymous editing link</h2>';
    if (isset($settings['anonymous_editing_key'])) {
        $request_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        echo <<< EOD
            <input disabled type="text" style="width: 32rem;" value="https://{$_SERVER['HTTP_HOST']}{$request_path}?key={$settings['anonymous_editing_key']}">
            <form action="?settings" method="post">
                <div class="form_row form_spaced">
                    <span></span>
                    <div>
                        <button name="toggle_anonymous_editing">Disable</button>
                    </div>
                </div>
            </form>
        EOD;
    } else {
        echo <<< EOD
            <form action="?settings" method="post">
                <div class="form_row form_spaced">
                    <span></span>
                    <div>
                        <button name="toggle_anonymous_editing">Enable</button>
                    </div>
                </div>
            </form>
        EOD;
    }

    echo '<h2>Purge past events</h2>';

    $first_day_in_calendar = get_first_day_in_calendar($settings);
    $four_weeks_before_first_calendar_day = date('Y-m-d', strtotime("{$first_day_in_calendar} - 28 days"));

    $events_before_first_day_in_calendar = 0;
    $events_before_four_weeks_before_first_calendar_day = 0;

    $events = get_events();
    foreach ($events as $event) {
        if ($event['date'] < $first_day_in_calendar) {
            $events_before_first_day_in_calendar++;

            if ($event['date'] < $four_weeks_before_first_calendar_day) {
                $events_before_four_weeks_before_first_calendar_day++;
            }
        }
    }

    if ($events_before_first_day_in_calendar > 0) {
        echo '<form action="?delete_past" method="post" onsubmit="return confirm(\'Really purge past events?\');">';

        if ($events_before_four_weeks_before_first_calendar_day > 0) {
            echo <<< EOD
                <div class="form_row form_spaced">
                    <span></span>
                    <div>
                        <button name="before_date" value="{$four_weeks_before_first_calendar_day}">Purge {$events_before_four_weeks_before_first_calendar_day} events older than four weeks</button>
                    </div>
                </div>
            EOD;
        }

        if ($events_before_first_day_in_calendar > $events_before_four_weeks_before_first_calendar_day) {
            echo <<< EOD
                <div class="form_row form_spaced">
                    <span></span>
                    <div>
                        <button name="before_date" value="{$first_day_in_calendar}">Purge all {$events_before_first_day_in_calendar} past events (includes recent ones)</button>
                    </div>
                </div>
            EOD;
        }

        echo '</form>';
    } else {
        echo '<p>No past events</p>';
    }

    echo '</div>';

    render_layout_end();
}

function render_setup(
    string $admin_name = '',
    string $admin_password = '',
    string $admin_password_confirmation = '',
    string $admin_username = '',
    string $start_of_week = DEFAULT_START_OF_WEEK,
    string $title = '',
    string $error = ''
) {
    render_layout_begin(DEFAULT_TITLE);

    // Any recent php version should work, so we don't even check that.
    // The only requirement we check for is https://www.php.net/manual/en/book.mbstring.php
    $requirements_met = extension_loaded('mbstring');

    if ($requirements_met) {
        $admin_name_encoded = htmlspecialchars($admin_name);
        $admin_password_encoded = htmlspecialchars($admin_password);
        $admin_password_confirmation_encoded = htmlspecialchars($admin_password_confirmation);
        $admin_username_encoded = htmlspecialchars($admin_username);
        $title_encoded = htmlspecialchars($title);

        $monday_selected = $start_of_week === 'monday' ? ' selected' : '';
        $sunday_selected = $start_of_week === 'sunday' ? ' selected' : '';

        echo <<< EOD
            <div class="center">
                <form action="./" method="post">
                    {$requirements_error}
                    {$error}
                    <div class="form_row">
                        <label for="title">Title of the calendar</label>
                        <input id="title"
                               name="title"
                               required
                               type="text"
                               value="{$title_encoded}">
                    </div>
                    <div class="form_row">
                        <label for="start_of_week">Start of week</label>
                        <select id="start_of_week" name="start_of_week">
                            <option{$sunday_selected} value="sunday">Sunday</option>
                            <option{$monday_selected} value="monday">Monday</option>
                        </select>
                    </div>
                    <div class="form_row">
                        <label for="admin_username">Administrator username</label>
                        <input id="admin_username"
                               name="admin_username"
                               pattern="[^\s]+"
                               required
                               type="text"
                               value="{$admin_name_encoded}">
                    </div>
                    <div class="form_row">
                        <label for="admin_name">Administrator name</label>
                        <input id="admin_name"
                               name="admin_name"
                               required
                               type="text"
                               value="{$admin_name_encoded}">
                    </div>
                    <div class="form_row">
                        <label for="admin_password">Administrator password</label>
                        <input id="admin_password"
                               name="admin_password"
                               required
                               type="password"
                               value="{$admin_password_encoded}">
                    </div>
                    <div class="form_row">
                        <label for="admin_password_confirmation">Confirm administrator password</label>
                        <input id="admin_password_confirmation"
                               name="admin_password_confirmation"
                               required
                               type="password"
                               value="{$admin_password_confirmation_encoded}">
                    </div>
                    <div class="form_row form_spaced">
                        <span></span>
                        <button>Complete first time setup</button>
                    </div>
                </form>
            </div>
        EOD;
    } else {
        $svg_logo = SVG_LOGO;

        echo <<< EOD
            <div class="center">
                <div class="page">
                    {$svg_logo}
                    <p>
                        Feber requires the PHP <a href="https://www.php.net/manual/en/book.mbstring.php" target="_blank">Multibyte String</a> extension.<br>
                        Please <a href="https://www.php.net/manual/en/mbstring.installation.php" target="_blank">install and/or enable</a> it, then visit this page again.
                    </p>
                </div>
            </div>
        EOD;
    }

    render_layout_end();
}

function render_shortcuts(array $active_user, array $settings) {
    render_layout_begin($settings['title']);
    render_header($active_user, $settings);

    if (has_delete_permission($active_user)) {
        $deleting_instruction = <<< EOD
            <strong>Deleting events</strong>
            <p>
                Press <code>x</code> while your mouse cursor hovers the title of an event in the
                calendar. Repeat this for more events if you want to delete multiple at once.
                Then press <code>Enter</code> to confirm or <code>Escape</code> to cancel.
            </p>
        EOD;
    } else {
        $deleting_instruction = '';
    }

    if (has_create_permission($active_user)) {
        $repeating_instruction = <<< EOD
            <strong>Repeating events</strong>
            <p>
                While your mouse cursor hovers the title of an event in the calendar, press <code>d</code>
                for daily, <code>w</code> for weekly or <code>b</code> for biweekly repetition.
                Then use the number keys to enter the amount of times the event should be repeated, using
                <code>Backspace</code> for corrections. Finally, press <code>Enter</code> to
                confirm or <code>Escape</code> to cancel.
            </p>
        EOD;
    } else {
        $repeating_instruction = '';
    }

    echo <<< EOD
        <div class="page">
            <h1>Keyboard Shortcuts</h1>
            {$deleting_instruction}
            {$repeating_instruction}
            <strong>Viewing past events</strong>
            <p>
                In the main calendar view, press <code>r</code> to reverse the flow of time.
                The current week will be shown as before, but the weeks below will go into
                the past instead the future.
            </p>
        </div>
    EOD;

    render_layout_end();
}

function render_user(array $active_user, array $settings, array $user) {
    render_layout_begin($user['name']);
    render_header($active_user, $settings);

    $name_escaped = htmlspecialchars($user['name']);
    $username_escaped = htmlspecialchars($user['username']);

    if ($active_user['permissions'] === 'admin') {
        $viewer_selected = $user['permissions'] === 'viewer' ? ' selected' : '';
        $organizer_selected = $user['permissions'] === 'organizer' ? ' selected' : '';
        $editor_selected = $user['permissions'] === 'editor' ? ' selected' : '';
        $admin_selected = $user['permissions'] === 'admin' ? ' selected' : '';
        $permissions_field = <<< EOD
            <div class="form_row form_spaced">
                <span>Permissions</span>
                <select name="permissions">
                    <option{$viewer_selected} value="viewer">Viewer – can only view events</option>
                    <option{$organizer_selected} value="organizer">Organizer – can edit own events</option>
                    <option{$editor_selected} value="editor">Editor – can edit all events</option>
                    <option{$admin_selected} value="admin">Admin – can edit everything</option>
                </select>
            </div>
        EOD;

        $cancel_href = '?users';
    } else {
        $permissions_field = '';
        $cancel_href = './';
    }

    if ($active_user['id'] === $user['id'] || $active_user['permissions'] !== 'admin') {
        $old_password_field = <<< EOD
            <div class="form_row form_spaced">
                <label for="old_password">Old Password</label>
                <input
                    id="old_password"
                    name="old_password"
                    required
                    type="password">
            </div>
        EOD;
    } else {
        $old_password_field = '';
    }

    echo <<< EOD
        <div class="page">
            <h1>{$name_escaped}</h1>
            <form action="?user={$user['id']}" method="post">
                <div class="form_row form_spaced">
                    <label for="username">Username</label>
                    <input id="username"
                           name="username"
                           pattern="[^\s]+"
                           required
                           type="text"
                           value="{$username_escaped}">
                </div>
                <div class="form_row form_spaced">
                    <label for="name">Name</label>
                    <input
                        id="name"
                        name="name"
                        required
                        type="text"
                        value="{$name_escaped}">
                </div>
                {$permissions_field}
                <div class="form_row form_spaced">
                    <span></span>
                    <div>
                        <button name="update">Save</button>
                        <a class="button cancel" href="{$cancel_href}">Cancel</a>
                    </div>
                </div>
            </form>
            <h2 class="margin_top">Change password</h2>
            <form action="?user={$user['id']}" method="post">
                {$old_password_field}
                <div class="form_row form_spaced">
                    <label for="new_password">New password</label>
                    <input 
                        id="new_password"
                        name="new_password"
                        required
                        type="password">
                </div>
                <div class="form_row form_spaced">
                    <label for="new_password_confirmation">Repeat new password</label>
                    <input
                        id="new_password_confirmation"
                        name="new_password_confirmation"
                        required
                        type="password">
                </div>
                <div class="form_row form_spaced">
                    <span></span>
                    <div>
                        <button name="change_password">Change password</button>
                        <a class="button cancel" href="{$cancel_href}">Cancel</a>
                    </div>
                </div>
            </form>
            <h2 class="margin_top">Delete user</h2>
            <p>
                Deleting your user is instant and permanent - your events however will not be deleted,
                only orphaned. If you want to delete absolutely everything, please first delete your events as well.
            </p>
            <form action="?user={$user['id']}" method="post" onsubmit="return confirm('Really delete user?');">
                <div class="form_row form_spaced">
                    <span></span>
                    <div>
                        <button name="delete">Delete user</button>
                    </div>
                </div>
            </form>
        </div>
    EOD;

    render_layout_end();
}

function render_users(array $active_user, array $settings) {
    render_layout_begin('Users');
    render_header($active_user, $settings);

    $user_links = '';
    foreach ($settings['users'] as $user) {
        $name_escaped = htmlspecialchars($user['name']);
        $you = $active_user['id'] === $user['id'] ? ' (you)' : '';

        $user_links .= <<< EOD
            <a href="?user={$user['id']}">{$name_escaped}{$you}</a><br>
        EOD;
    }

    echo <<< EOD
    <div class="page">
        <h1>Users</h1>
        <p>
            {$user_links}
        </p>
        <h2>New user</h2>
        <form action="?settings" method="post">
            <div class="form_row">
                <label for="username">Username</label>
                <input
                    id="username"
                    name="username"
                    pattern="[^\s]+"
                    required
                    type="text">
            </div>
            <div class="form_row">
                <label for="name">Name</label>
                <input
                    id="name"
                    name="name"
                    required
                    type="text">
            </div>
            <div class="form_row">
                <label for="password">Password</label>
                <input
                    id="password"
                    name="password"
                    required
                    type="text">
            </div>
            <div class="form_row">
                <label for="permissions">Permissions</label>
                <select id="permissions" name="permissions">
                    <option value="viewer">Viewer – can only view events</option>
                    <option selected value="organizer">Organizer – can edit own events</option>
                    <option value="editor">Editor – can edit all events</option>
                    <option value="admin">Admin – can edit everything</option>
                </select>
            </div>
            <div class="form_row form_spaced">
                <span></span>
                <div>
                    <button name="add_user">Add user</button>
                </div>
            </div>
        </form>
    </div>
    EOD;

    render_layout_end();
}

function update_markers (array $events, array $settings) {
    $markers = get_markers();
    $marker_seeds = array_values($markers);

    sort($marker_seeds);

    $marker_seeds_index = 0;
    $next_marker_seed = 0;

    foreach ($events as $event) {
        if (isset($event['title'])) {
            $title_or_owner = $event['title'];
        } else {
            $event_owner = get_event_owner($settings['users'], $event['owner_id']);
            $title_or_owner = $event_owner['name'];
        }

        if (isset($new_markers[$title_or_owner])) {
            continue;
        }

        if (isset($markers[$title_or_owner])) {
            $new_markers[$title_or_owner] = $markers[$title_or_owner];
            continue;
        }

        while (true) {
            if ($marker_seeds_index === count($marker_seeds) ||
                $next_marker_seed < $marker_seeds[$marker_seeds_index]) {
                $new_markers[$title_or_owner] = $next_marker_seed;
                $next_marker_seed++;
                break;
            }

            while ($marker_seeds_index < count($marker_seeds) &&
                $next_marker_seed === $marker_seeds[$marker_seeds_index]) {
                $marker_seeds_index++;
                $next_marker_seed++;
            }
        }
    }

    persist_markers($new_markers);
}

// ***********************************************
// * From here on begins the actual program flow *
// ***********************************************

if (!file_exists(FILENAME_LOG_PHP)) {
    $prelude = "<?php" . PHP_EOL;
    file_put_contents(FILENAME_LOG_PHP, $prelude, LOCK_EX);
}

// TODO: Remove February 2025 (introduced September 2024)
// Migrate the exposed .txt log file from <= 1.1.2 installations
// to the protected .php file written by >= 1.1.3 installations.
if (file_exists(FILENAME_LOG_TXT)) {
    $log_txt = file_get_contents(FILENAME_LOG_TXT);

    $line_separators = "\r\n";
    $line = strtok($log_txt, $line_separators);

    while ($line !== false) {
        $log_line = "// {$line}" . PHP_EOL;
        file_put_contents(FILENAME_LOG_PHP, $log_line, FILE_APPEND | LOCK_EX);
        $line = strtok($line_separators);
    }

    unlink(FILENAME_LOG_TXT);
}

if (!file_exists(FILENAME_SETTINGS_PHP)) {
    if (isset($_POST['admin_password'])) {
        if ($_POST['admin_password'] !== $_POST['admin_password_confirmation']) {
            $error = 'Admin key confirmation does not match admin key';
        } else if (!isset($_POST['admin_name'])) {
            $error = 'Name must be set';
        } else if (!is_valid_username($_POST['admin_username'])) {
            $error = 'Invalid username';
        }

        if (isset($error)) {
            render_setup(
                $_POST['admin_name'],
                $_POST['admin_password'],
                $_POST['admin_password_confirmation'],
                $_POST['admin_username'],
                $_POST['start_of_week'],
                $_POST['title'],
                $error
            );
            exit;
        }

        persist_settings([
            'anonymous_editing_key' => null,
            'anonymous_viewing_key' => null,
            'booking_mode' => DEFAULT_BOOKING_MODE,
            'start_of_week' => $_POST['start_of_week'],
            'title' => $_POST['title'],
            'users' => [
                [
                    'id' => random_id(),
                    'name' => $_POST['admin_name'],
                    'password_hash' => password_hash($_POST['admin_password'], PASSWORD_BCRYPT),
                    'permissions' => 'admin',
                    'username' => $_POST['admin_username']
                ]
            ],
            'weeks_shown' => DEFAULT_WEEKS_SHOWN
        ]);

        header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
    } else {
        render_setup();
    }

    exit;
}

include FILENAME_SETTINGS_PHP;

if (isset($_GET['ics'])) {
    if (isset($settings['ics_key']) && $_GET['ics'] === $settings['ics_key']) {
        $events = get_events();
        // TODO: Encoding the name of the calendar into the filename would make
        //       (more) sense, but entails not-so-trivial sanitization.
        header("Content-Disposition: inline; filename=\"{$settings['ics_key']}.ics\"");
        header('Content-Type: text/calendar');
        render_ics($events, $settings);
        exit;
    } else {
        exit('Invalid ics key, please contact the administrator if you think this is in error.');
    }
}

session_start();

if (isset($_GET['logout'])) {
    session_unset();
    header("Location: ./", true, 303);
    exit;
}

if (isset($_SESSION['key'])) {
    if (isset($settings['anonymous_viewing_key']) &&
        $_SESSION['key'] === $settings['anonymous_viewing_key']) {
        $active_user = ANONYMOUS_VIEWING_USER;
    } else if (isset($settings['anonymous_editing_key']) &&
        $_SESSION['key'] === $settings['anonymous_editing_key']) {
        $active_user = ANONYMOUS_EDITING_USER;
    } else {
        unset($_SESSION['key']);
        $error = 'The key stored in your session has become invalid, please contact the administrator for renewed access.';
        render_login($settings, $error);
        exit;
    }
} else if (isset($_SESSION['user_id'])) {
    foreach ($settings['users'] as $user) {
        if ($user['id'] === $_SESSION['user_id']) {
            $active_user = $user;
            break;
        }
    }

    if (!isset($active_user)) {
        unset($_SESSION['user_id']);
        $error = 'The user stored in your session has become invalid, please contact the administrator for renewed access.';
        render_login($settings, $error);
        exit;
    }
} else {
    if (isset($_GET['key'])) {
        if ((isset($settings['anonymous_viewing_key']) &&
             $_GET['key'] === $settings['anonymous_viewing_key']) ||
            (isset($settings['anonymous_editing_key']) &&
            $_GET['key'] === $settings['anonymous_editing_key'])) {
            $_SESSION['key'] = $_GET['key'];
            header("Location: ./", true, 303);
            exit;
        }

        $error = 'The key provided in the link you followed is not valid, please contact the administrator if you think it should be.';
        render_login($settings, $error);
    } else if (isset($_GET['login'])) {
        if (!isset($_POST['username']) || !isset($_POST['password'])) {
            exit('Invalid POST data for login');
        }

        foreach ($settings['users'] as $user) {
            if (mb_strtolower($_POST['username']) === mb_strtolower($user['username']) &&
                password_verify($_POST['password'], $user['password_hash'])) {
                $_SESSION['user_id'] = $user['id'];
                header("Location: ./", true, 303);
                exit;
            }
        }

        $error = 'Invalid username and/or password, please try again.';
        render_login($settings, $error);
    } else {
        render_login($settings);
    }

    exit;
}

if (isset($_GET['delete'])) {
    $events = get_events();

    $events_altered = false;
    $events_new = [];

    foreach($events as $event) {
        if (in_array($event['id'], $_POST['ids']) &&
            ($active_user['permissions'] === 'admin' ||
             $active_user['permissions'] === 'editor' ||
             ($active_user['permissions'] === 'organizer' && $active_user['id'] === $event['owner_id']))) {
            $events_altered = true;
            $with_note = isset($event['note']) ? '(with note)' : '(without note)';

            $event_owner = get_event_owner($settings['users'], $event['owner_id']);
            $title = isset($event['title']) ? ' ' . $event['title'] : '';

            log_line("{$active_user['name']} deleted {$event_owner['name']}'s event {$event['date']} {$event['from']}-{$event['to']}{$title} {$with_note}");
        } else {
            $events_new[] = $event;
        }
    }

    if ($events_altered) {
        persist_events($events_new);
        update_markers($events_new, $settings);
    }

    header("Location: ./", true, 303);
    exit;
} else if (isset($_GET['delete_past'])) {
    if (!isset($_POST['before_date']) || !is_valid_date($_POST['before_date'])) {
        exit('Invalid GET data for deleting past events.');
    }

    $events = get_events();

    $events_filtered = array_filter($events, fn($event) => $event['date'] >= $_POST['before_date']);
    if (count($events_filtered) < count($events)) {
        $events_new = array_values($events_filtered);
        persist_events($events_new);
        update_markers($events_new, $settings);
    }

    header("Location: ./", true, 303);
    exit;
} else if (isset($_GET['event'])) {
    $events = get_events();

    if (isset($_POST['save'])) {
        // Guard against forged requests
        if (!isset($_POST['date']) || !is_valid_date($_POST['date']) ||
            !isset($_POST['from']) || !is_valid_time($_POST['from']) ||
            !isset($_POST['to']) || !is_valid_time($_POST['to'])) {
            exit('Invalid POST data for event edit.');
        }

        foreach($events as &$event) {
            if ($event['id'] === $_GET['event']) {
                // Guard against missing permission
                if ($active_user['permissions'] !== 'admin' &&
                    $active_user['permissions'] !== 'editor' &&
                    !($active_user['permissions'] === 'organizer' && $active_user['id'] === $event['owner_id'])) {
                    exit('Insufficient permissions to edit event.');
                }

                if (isset($_POST['owner_id'])) {
                    $event['owner_id'] = $_POST['owner_id'];
                }

                $event['date'] = $_POST['date'];
                $event['from'] = $_POST['from'];
                $event['to'] = $_POST['to'];

                if (isset($_POST['note']) && strlen(trim($_POST['note'])) > 0) {
                    $event['note'] = trim($_POST['note']);
                } else {
                    unset($event['note']);
                }

                if (isset($_POST['title']) && strlen(trim($_POST['title'])) > 0) {
                    $event['title'] = trim($_POST['title']);
                } else {
                    unset($event['title']);
                }

                persist_events($events);
                update_markers($events, $settings);

                $note_escaped = isset($event['note']) ? ' ' . addcslashes($event['note'], "\n") : '';
                $title = isset($event['title']) ? ' ' . $event['title'] : '';

                log_line("{$active_user['name']} edited {$event['owner_id']}'s event {$event['date']} {$event['from']}-{$event['to']}{$title}{$note_escaped}");

                header("Location: ./", true, 303);
                exit;
            }
        }

        exit('Invalid event id.');
    }

    foreach ($events as $event) {
        if ($event['id'] === $_GET['event']) {
            render_event($active_user, $event, $settings);
            exit;
        }
    }
} else if (isset($_GET['repeat'])) {
    // This is just a safety check, we do not expect this to ever fail
    // unless somebody willfully experiments with forged requests.
    if (
        !isset($_POST['count']) || !is_valid_int($_POST['count']) ||
        !isset($_POST['id']) ||
        !isset($_POST['interval']) || ($_POST['interval'] !== 'biweekly' && $_POST['interval'] !== 'daily' && $_POST['interval'] !== 'weekly')
    ) {
        exit('Invalid POST data for event repetition.');
    }

    $events = get_events();

    $events_altered = false;

    if ($_POST['interval'] === 'biweekly') {
        $interval_days = 14;
    } else if ($_POST['interval'] === 'daily') {
        $interval_days = 1;
    } else if ($_POST['interval'] === 'weekly') {
        $interval_days = 7;
    }

    foreach($events as $index => $event) {
        if ($event['id'] === $_POST['id'] &&
            ($active_user['permissions'] === 'admin' ||
             $active_user['permissions'] === 'editor' ||
             ($active_user['permissions'] === 'organizer' && $active_user['id'] === $event['owner_id']))) {
            $iterated_date = $event['date'];

            $today_iso = date('Y-m-d');
            $last_day_in_calendar = get_last_day_in_calendar($settings);

            $count = 0;

            while ($count < (int)$_POST['count']) {
                $iterated_date = date('Y-m-d', strtotime("{$iterated_date} + {$interval_days} days"));

                if ($iterated_date < $today_iso || $iterated_date > $last_day_in_calendar) {
                    break;
                }

                $event_copy = [
                    'date' => $iterated_date,
                    'from' => $event['from'],
                    'id' => random_id(),
                    'owner_id' => $event['owner_id'],
                    'to' => $event['to']
                ];

                if (isset($event['note'])) {
                    $event_copy['note'] = $event['note'];
                }

                if (isset($event['title'])) {
                    $event_copy['title'] = $event['title'];
                }

                $events[] = $event_copy;
                $events_altered = true;
                $count++;
            }

            $event_owner = get_event_owner($settings['users'], $event['owner_id']);
            $title = isset($event['title']) ? ' ' . $event['title'] : '';

            log_line("{$active_user['name']} repeated {$event_owner['name']}'s event {$event['date']} {$event['from']}-{$event['to']}{$title} {$_POST['interval']} {$count} times");

            break;
        }
    }


    if ($events_altered) {
        usort($events, fn($a, $b) => $a['date'] . $a['from'] <=> $b['date'] . $b['from']);
        persist_events($events);
    }

    header("Location: ./", true, 303);
    exit;
} else if (isset($_GET['create']) && has_create_permission($active_user)) {
    if (isset($_POST['submit'])) {
        // This is just a safety check, we do not expect this to ever fail
        // unless somebody willfully experiments with forged requests.
        if (
            !isset($_POST['date']) || !is_valid_date($_POST['date']) ||
            !isset($_POST['from']) || !is_valid_time($_POST['from']) ||
            !isset($_POST['to']) || !is_valid_time($_POST['to']) ||
            !(isset($_POST['repeats']) || !(
                $_POST['repeats'] === 'never' ||
                $_POST['repeats'] === 'daily' ||
                $_POST['repeats'] === 'weekly' ||
                $_POST['repeats'] === 'biweekly'
            )) ||
            (isset($_POST['repeats']) && $_POST['repeats'] !== 'never' && (!isset($_POST['until']) || !is_valid_date($_POST['until'])))
        ) {
            exit('Invalid POST data for event creation.');
        }

        $events = get_events();

        $iterated_date = $_POST['date'];
        $today_iso = date('Y-m-d');
        $last_day_in_calendar = get_last_day_in_calendar($settings);

        for ($i = 0; $i < MAX_CLONED_EVENTS; $i++) {
            if ($iterated_date < $today_iso || $iterated_date > $last_day_in_calendar) {
                break;
            }

            $event_new = [
                'date' => $iterated_date,
                'from' => $_POST['from'],
                'id' => random_id(),
                'owner_id' => $active_user['id'],
                'to' => $_POST['to']
            ];

            if (isset($_POST['note']) && strlen(trim($_POST['note'])) > 0) {
                $event_new['note'] = $_POST['note'];
            }

            if (isset($_POST['title']) && strlen(trim($_POST['title'])) > 0) {
                $event_new['title'] = $_POST['title'];
            }

            $events[] = $event_new;

            if ($_POST['repeats'] === 'never') {
                break;
            } else if ($_POST['repeats'] === 'daily') {
                $iterated_date = date('Y-m-d', strtotime("{$iterated_date} + 1 day"));
            } else if ($_POST['repeats'] === 'weekly') {
                $iterated_date = date('Y-m-d', strtotime("{$iterated_date} + 7 days"));
            } else if ($_POST['repeats'] === 'biweekly') {
                $iterated_date = date('Y-m-d', strtotime("{$iterated_date} + 14 days"));
            }

            if ($iterated_date > $_POST['until']) {
                break;
            }
        }

        usort($events, fn($a, $b) => $a['date'] . $a['from'] <=> $b['date'] . $b['from']);

        $note_escaped = isset($_POST['note']) ? addcslashes($_POST['note'], "\n") : '';
        log_line("{$active_user['name']} created {$_POST['date']} {$_POST['from']}-{$_POST['to']} {$note_escaped}");

        persist_events($events);
        update_markers($events, $settings);
        header("Location: ./", true, 303);
        exit;
    }

    $date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

    render_create($active_user, $date, $settings);
} else if (isset($_GET['settings'])) {
    if ($active_user['permissions'] !== 'admin') {
        exit('Insufficient permissions to edit settings.');
    }

    if (isset($_POST['save_settings'])) {
        if (!(isset($_POST['booking_mode']) || !($_POST['booking_mode'] === 'free' || $_POST['booking_mode'] === 'name'))) {
            exit('Invalid POST data for settings.');
        }

        $settings['booking_mode'] = $_POST['booking_mode'];
        $settings['start_of_week'] = $_POST['start_of_week'];
        $settings['title'] = $_POST['title'];
        $settings['weeks_shown'] = (int)$_POST['weeks_shown'];

        persist_settings($settings);
        header("Location: ./", true, 303);
        exit;
    } else if (isset($_POST['add_user'])) {
        if (!isset($_POST['name']) ||
            !isset($_POST['password']) ||
            !isset($_POST['permissions']) || !is_valid_permissions($_POST['permissions']) ||
            !isset($_POST['username']) || !is_valid_username($_POST['username'])) {
            exit('Invalid POST data for user creation.');
        }

        foreach ($settings['users'] as $user) {
            if (mb_strtolower($user['username']) === mb_strtolower($_POST['username'])) {
                // TODO: Should be rendered on the page itself.
                exit('User can not be created because the chosen username is already taken.');
            }
        }

        $settings['users'][] = [
            'id' => random_id(),
            'name' => $_POST['name'],
            'password_hash' => password_hash($_POST['password'], PASSWORD_BCRYPT),
            'permissions' => $_POST['permissions'],
            'username' => $_POST['username']
        ];

        usort($settings['users'], fn($a, $b) => $a['name'] <=> $b['name']);        

        persist_settings($settings);
        header("Location: ./?users", true, 303);
        exit;
    } else if (isset($_POST['toggle_anonymous_editing'])) {
        if (isset($settings['anonymous_editing_key'])) {
            unset($settings['anonymous_editing_key']);
        } else {
            $settings['anonymous_editing_key'] = random_id();
        }

        persist_settings($settings);
        header("Location: ./?settings", true, 303);
        exit;
    } else if (isset($_POST['toggle_anonymous_viewing'])) {
        if (isset($settings['anonymous_viewing_key'])) {
            unset($settings['anonymous_viewing_key']);
        } else {
            $settings['anonymous_viewing_key'] = random_id();
        }

        persist_settings($settings);
        header("Location: ./?settings", true, 303);
        exit;
    } else if (isset($_POST['toggle_ical_subscription'])) {
        if (isset($settings['ics_key'])) {
            unset($settings['ics_key']);
        } else {
            $settings['ics_key'] = random_id();
        }

        persist_settings($settings);
        header("Location: ./?settings", true, 303);
        exit;
    }

    render_settings($active_user, $settings);
} else if (isset($_GET['shortcuts'])) {
    render_shortcuts($active_user, $settings);
} else if (isset($_GET['users'])) {
    if ($active_user['permissions'] !== 'admin') {
        exit('Insufficient permissions to edit users.');
    }

    render_users($active_user, $settings);
} else if (isset($_GET['user'])) {
    if ($active_user['permissions'] !== 'admin' && $active_user['id'] !== $_GET['user']) {
        exit('Insufficient permissions to edit user.');
    }

    if (isset($_POST['delete'])) {
        $admin_present = false;
        $new_users = [];
        foreach ($settings['users'] as $user) {
            if ($user['id'] !== $_GET['user']) {
                $new_users[] = $user;
                if ($user['permissions'] === 'admin') {
                    $admin_present = true;
                }
            }
        }

        if (!$admin_present) {
            exit('User can not be deleted because without it there would be no remaining admin.');
        }

        $settings['users'] = $new_users;

        persist_settings($settings);
        update_markers(get_events(), $settings);

        if ($active_user['id'] === $_GET['user']) {
            unset($_SESSION['user_id']);
            header("Location: ./", true, 303);
        } else {
            header("Location: ./?settings", true, 303);
        }

        exit;
    }

    if (isset($_POST['update'])) {
        if (!isset($_POST['username'])) {
            exit('Username must be provided.');
        }

        if (!is_valid_username($_POST['username'])) {
            exit('Invalid username.');
        }

        if (!isset($_POST['name']) || strlen(trim($_POST['name'])) === 0) {
            exit('Name must be provided and non-empty.');
        }

        foreach ($settings['users'] as $user) {
            if ($user['id'] !== $_GET['user'] && mb_strtolower($user['username']) === mb_strtolower($_POST['username'])) {
                // TODO: Should be rendered on the page itself.
                exit('User can not be updated because the chosen username is already taken.');
            }
        }

        if (isset($_POST['permissions'])) {
            if (!is_valid_permissions($_POST['permissions'])) {
                exit('Invalid permissions.');
            }

            if ($active_user['permissions'] !== 'admin') {
                exit('Insufficient permissions to alter permissions.');
            }

            if ($_POST['permissions'] !== 'admin') {
                $admin_present = false;
                foreach ($settings['users'] as $user) {
                    if ($user['id'] !== $_GET['user'] && $user['permissions'] === 'admin') {
                        $admin_present = true;
                        break;
                    }
                }

                if (!$admin_present) {
                    // TODO: Should be rendered on the page itself.
                    exit('User can not be made non-admin because without it there would be no remaining admin.');
                }
            }
        }

        foreach ($settings['users'] as &$user) {
            if ($user['id'] === $_GET['user']) {
                $user['username'] = $_POST['username'];
                $user['name'] = $_POST['name'];

                if (isset($_POST['permissions'])) {
                    $user['permissions'] = $_POST['permissions'];
                }

                usort($settings['users'], fn($a, $b) => $a['name'] <=> $b['name']);

                persist_settings($settings);
                update_markers(get_events(), $settings);
                header("Location: ./?user={$_GET['user']}", true, 303);
                exit;
            }
        }
    }

    if (isset($_POST['change_password'])) {
        foreach ($settings['users'] as &$user) {
            if ($user['id'] === $_GET['user']) {
                if ($_GET['user'] === $active_user['id']) {
                    if (!isset($_POST['old_password']) || $_POST['old_password'] === '') {
                        exit('Old password needs to be filled out');
                    }

                    if (!password_verify($_POST['old_password'], $active_user['password_hash'])) {
                        // TODO: Should be rendered on the page itself.
                        exit('Old password is not correct.');
                    }
                }

                if (!isset($_POST['new_password']) || $_POST['new_password'] === '' ||
                    !isset($_POST['new_password_confirmation']) || $_POST['new_password_confirmation'] === '') {
                    exit('New password field and confirmation must be filled out.');
                }

                if ($_POST['new_password'] !== $_POST['new_password_confirmation']) {
                    // TODO: Should be rendered on the page itself.
                    exit('New password and new password confirmation do not match.');
                }

                $user['password_hash'] = password_hash($_POST['new_password'], PASSWORD_BCRYPT);

                persist_settings($settings);
                header("Location: ./?user={$_GET['user']}", true, 303);
                exit;
            }
        }
    }

    foreach ($settings['users'] as $user) {
        if ($user['id'] === $_GET['user']) {
            render_user($active_user, $settings, $user);
            exit;
        }
    }

    exit('Invalid user id.');
} else if (isset($_GET['reverse'])) {
    if (isset($_SESSION['reverse'])) {
        unset($_SESSION['reverse']);
    } else {
        $_SESSION['reverse'] = true;
    }

    header("Location: ./", true, 303);
    exit;
} else {
    $events = get_events();
    $markers = get_markers();
    render_calendar($active_user, $events, $markers, $settings);
}
