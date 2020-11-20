/**
 * WordPress dependencies
 */

import { __ } from '@wordpress/i18n';

export const getColumns = () => ([
    {
        label: __('1 column', 'wps-gutenberg-blocks'),
        value: 1,
    },
    {
        label: __('2 columns', 'wps-gutenberg-blocks'),
        value: 2,
    },
    {
        label: __('3 columns', 'wps-gutenberg-blocks'),
        value: 3,
    },
    {
        label: __('4 columns', 'wps-gutenberg-blocks'),
        value: 4,
    },
    {
        label: __('5 columns', 'wps-gutenberg-blocks'),
        value: 5,
    },
    {
        label: __('6 columns', 'wps-gutenberg-blocks'),
        value: 6,
    },
]);