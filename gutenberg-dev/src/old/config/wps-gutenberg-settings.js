var removeBlocks = [
    'core/paragraph',
    'core/heading',
    'core/image'
];

wp.domReady(function () {
    removeBlocks.forEach(function (blockName) {
        wp.blocks.unregisterBlockType(blockName);
    });
});