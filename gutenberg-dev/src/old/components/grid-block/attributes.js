export const attributes = {
	columnWidthPhone: {
		type: 'string',
		default: '',
	},
	columnWidthPortable: {
		type: 'string',
		default: '',
	},
	columnWidthLap: {
		type: 'string',
		default: '',
	},
	columnWidthLapAndUp: {
		type: 'string',
		default: '6/12',
	},
	columnWidthDesk: {
		type: 'string',
		default: '',
	},
	verticalAlignment: {
		type: 'string',
		default: '',
	},
	cssClass: {
		type: 'string',
		default: '',
	},
	cssId: {
		type: 'string',
		default: '',
	},
	innerCssClass: {
		type: 'string',
		default: '',
	},
	innerVAlign: {
		type: 'string',
		default: '',
	},
};

const marginAttributes = {
	marginTop: {
		type: 'string',
		default: '',
	},
	marginBottom: {
		type: 'string',
		default: '',
	},
	marginRight: {
		type: 'string',
		default: '',
	},
	marginLeft: {
		type: 'string',
		default: '',
	},
	marginVertical: {
		type: 'string',
		default: '',
	},
	marginHorizontal: {
		type: 'string',
		default: '',
	},
	marginAll: {
		type: 'string',
		default: '',
	},
};
const innerMarginAttributes = {
	innerMarginTop: {
		type: 'string',
		default: '',
	},
	innerMarginBottom: {
		type: 'string',
		default: '',
	},
	innerMarginRight: {
		type: 'string',
		default: '',
	},
	innerMarginLeft: {
		type: 'string',
		default: '',
	},
	innerMarginVertical: {
		type: 'string',
		default: '',
	},
	innerMarginHorizontal: {
		type: 'string',
		default: '',
	},
	innerMarginAll: {
		type: 'string',
		default: '',
	},
};
const paddingAttributes = {
	paddingTop: {
		type: 'string',
		default: '',
	},
	paddingBottom: {
		type: 'string',
		default: '',
	},
	paddingRight: {
		type: 'string',
		default: '',
	},
	paddingLeft: {
		type: 'string',
		default: '',
	},
	paddingVertical: {
		type: 'string',
		default: '',
	},
	paddingHorizontal: {
		type: 'string',
		default: '',
	},
	paddingAll: {
		type: 'string',
		default: '',
	},
};

const innerPaddingAttributes = {
	innerPaddingTop: {
		type: 'string',
		default: '',
	},
	innerPaddingBottom: {
		type: 'string',
		default: '',
	},
	innerPaddingRight: {
		type: 'string',
		default: '',
	},
	innerPaddingLeft: {
		type: 'string',
		default: '',
	},
	innerPaddingVertical: {
		type: 'string',
		default: '',
	},
	innerPaddingHorizontal: {
		type: 'string',
		default: '',
	},
	innerPaddingAll: {
		type: 'string',
		default: '',
	},
};

export const spacingAttributes = {
	...marginAttributes,
	...innerMarginAttributes,
	...paddingAttributes,
	...innerPaddingAttributes,
};
