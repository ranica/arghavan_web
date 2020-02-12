/**
 * Ready function
 */
$()
	.ready(() =>
	{
		demo.checkFullPageBackgroundImage();

		setTimeout(() =>
		{
			$('.card').removeClass('card-hidden');
		}, 250);
});

window.v = new Vue(
{
	el: '#app',

	data:
	{
		email     : '',
		showAlerts: true
	},

	methods:
	{
		closeAlerts()
		{
			this.showAlerts = false;
		}
	}
});
