import classnames from 'classnames';
import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save( { attributes } ) {
	const blockProps = useBlockProps.save( {
		className: 'wzkb-alert',
	} );
	const { content, align, showHeading, heading, iconName } = attributes;
	const className = blockProps.className;

	return (
		<>
			<div { ...blockProps } className={ className }>
				{ showHeading && (
					<div className="wz-alert-heading">
						{ iconName !== 'none' && (
							<span
								className={ classnames( 'dashicons', {
									[ `dashicons-${ iconName }` ]:
										iconName !== 'none',
								} ) }
							></span>
						) }
						<strong>{ heading }</strong>
					</div>
				) }

				<RichText.Content
					tagName="div"
					value={ content }
					style={ { textAlign: align } }
					className="wz-alert-text"
				/>
			</div>
		</>
	);
}
