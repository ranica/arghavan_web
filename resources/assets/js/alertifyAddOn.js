alertify.defaults.glossary.title  = 'پیام';
alertify.defaults.glossary.ok     = 'تایید';
alertify.defaults.glossary.cancel = 'انصراف';

alertify.genericDialog || alertify.dialog('genericDialog', () =>
{
	return {
		main(content, callback = null)
		{
			this.setContent(content);

			if (null != callback)
			{
				callback();
			}
		},

		setup()
		{
			return {
				focus:
				{
					element()
					{
						return this.elements.body.querySelector(this.get('selector'));
					},

					select: true
				},

				options:
				{
					basic      : true,
					maximizable: false,
					resizable  : false,
					padding    : true
				}
			};
		},

		settings:
		{
			selector: undefined
		}
	};
});
