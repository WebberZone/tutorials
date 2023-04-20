import { __ } from '@wordpress/i18n';

import ServerSideRender from '@wordpress/server-side-render';

import { useBlockProps, InspectorControls } from '@wordpress/block-editor';

import {
	Disabled,
	TextControl,
	ToggleControl,
	PanelBody,
	PanelRow,
	QueryControls,
} from '@wordpress/components';

import metadata from './block.json';
import './editor.scss';

export default function Edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps( {
		className: 'wz-dynamic-block',
	} );

	const { postsToShow, showHeading, heading, order, orderBy } = attributes;

	const onChangeHeading = ( newHeading ) => {
		setAttributes( { heading: newHeading } );
	};

	const toggleHeading = () => {
		setAttributes( { showHeading: ! showHeading } );
	};

	return (
		<>
			<InspectorControls>
				<PanelBody
					title={ __( 'Settings', 'dynamic-block' ) }
					initialOpen={ true }
				>
					<PanelRow>
						<fieldset>
							<ToggleControl
								label={ __(
									'Show a heading before',
									'dynamic-block'
								) }
								help={
									showHeading
										? __(
												'Heading displayed',
												'dynamic-block'
										  )
										: __(
												'No Heading displayed',
												'dynamic-block'
										  )
								}
								checked={ showHeading }
								onChange={ toggleHeading }
							/>
						</fieldset>
					</PanelRow>
					{ showHeading && (
						<PanelRow>
							<fieldset>
								<TextControl
									label={ __( 'Heading', 'dynamic-block' ) }
									value={ heading }
									onChange={ onChangeHeading }
									help={ __(
										'Text to display above the alert box',
										'dynamic-block'
									) }
								/>
							</fieldset>
						</PanelRow>
					) }
					<QueryControls
						{ ...{ order, orderBy } }
						numberOfItems={ postsToShow }
						onOrderChange={ ( value ) =>
							setAttributes( { order: value } )
						}
						onOrderByChange={ ( value ) =>
							setAttributes( { orderBy: value } )
						}
						onNumberOfItemsChange={ ( value ) =>
							setAttributes( { postsToShow: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>

			<div { ...blockProps }>
				<Disabled>
					<ServerSideRender
						block={ metadata.name }
						skipBlockSupportAttributes
						attributes={ attributes }
					/>
				</Disabled>
			</div>
		</>
	);
}
