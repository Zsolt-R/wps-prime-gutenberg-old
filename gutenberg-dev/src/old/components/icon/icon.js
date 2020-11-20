const { registerBlockType } = wp.blocks;

registerBlockType('wps-prime/icon', {
    title: 'Icon',
    category: 'common',
    icon: 'smiley',
    description: 'Learning in progress',
    keywords: ['example', 'test'],
    edit: () => {
        return <div>:)</div>
    },
    save: () => {
        return <div>:)</div>
    }
});