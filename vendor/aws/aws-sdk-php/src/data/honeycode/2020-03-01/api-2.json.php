<?php
// This file was auto-generated from sdk-root/src/data/honeycode/2020-03-01/api-2.json
return [ 'version' => '2.0', 'metadata' => [ 'apiVersion' => '2020-03-01', 'endpointPrefix' => 'honeycode', 'jsonVersion' => '1.1', 'protocol' => 'rest-json', 'serviceAbbreviation' => 'Honeycode', 'serviceFullName' => 'Amazon Honeycode', 'serviceId' => 'Honeycode', 'signatureVersion' => 'v4', 'signingName' => 'honeycode', 'uid' => 'honeycode-2020-03-01', ], 'operations' => [ 'GetScreenData' => [ 'name' => 'GetScreenData', 'http' => [ 'method' => 'POST', 'requestUri' => '/screendata', ], 'input' => [ 'shape' => 'GetScreenDataRequest', ], 'output' => [ 'shape' => 'GetScreenDataResult', ], 'errors' => [ [ 'shape' => 'AccessDeniedException', ], [ 'shape' => 'InternalServerException', ], [ 'shape' => 'RequestTimeoutException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'ServiceUnavailableException', ], [ 'shape' => 'ThrottlingException', ], [ 'shape' => 'ValidationException', ], ], ], 'InvokeScreenAutomation' => [ 'name' => 'InvokeScreenAutomation', 'http' => [ 'method' => 'POST', 'requestUri' => '/workbooks/{workbookId}/apps/{appId}/screens/{screenId}/automations/{automationId}', ], 'input' => [ 'shape' => 'InvokeScreenAutomationRequest', ], 'output' => [ 'shape' => 'InvokeScreenAutomationResult', ], 'errors' => [ [ 'shape' => 'AccessDeniedException', ], [ 'shape' => 'InternalServerException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'ValidationException', ], [ 'shape' => 'ThrottlingException', ], [ 'shape' => 'ServiceUnavailableException', ], [ 'shape' => 'AutomationExecutionException', ], [ 'shape' => 'AutomationExecutionTimeoutException', ], [ 'shape' => 'RequestTimeoutException', ], ], ], ], 'shapes' => [ 'AccessDeniedException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'ErrorMessage', ], ], 'error' => [ 'httpStatusCode' => 403, ], 'exception' => true, ], 'AutomationExecutionException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'ErrorMessage', ], ], 'error' => [ 'httpStatusCode' => 400, ], 'exception' => true, ], 'AutomationExecutionTimeoutException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'ErrorMessage', ], ], 'error' => [ 'httpStatusCode' => 504, ], 'exception' => true, ], 'ClientRequestToken' => [ 'type' => 'string', 'max' => 64, 'min' => 32, ], 'ColumnMetadata' => [ 'type' => 'structure', 'required' => [ 'name', 'format', ], 'members' => [ 'name' => [ 'shape' => 'Name', ], 'format' => [ 'shape' => 'Format', ], ], ], 'DataItem' => [ 'type' => 'structure', 'members' => [ 'overrideFormat' => [ 'shape' => 'Format', ], 'rawValue' => [ 'shape' => 'RawValue', ], 'formattedValue' => [ 'shape' => 'FormattedValue', ], ], 'sensitive' => true, ], 'DataItems' => [ 'type' => 'list', 'member' => [ 'shape' => 'DataItem', ], ], 'ErrorMessage' => [ 'type' => 'string', ], 'Format' => [ 'type' => 'string', 'enum' => [ 'AUTO', 'NUMBER', 'CURRENCY', 'DATE', 'TIME', 'DATE_TIME', 'PERCENTAGE', 'TEXT', 'ACCOUNTING', 'CONTACT', 'ROWLINK', ], ], 'FormattedValue' => [ 'type' => 'string', ], 'GetScreenDataRequest' => [ 'type' => 'structure', 'required' => [ 'workbookId', 'appId', 'screenId', ], 'members' => [ 'workbookId' => [ 'shape' => 'ResourceId', ], 'appId' => [ 'shape' => 'ResourceId', ], 'screenId' => [ 'shape' => 'ResourceId', ], 'variables' => [ 'shape' => 'VariableValueMap', ], 'maxResults' => [ 'shape' => 'MaxResults', ], 'nextToken' => [ 'shape' => 'PaginationToken', ], ], ], 'GetScreenDataResult' => [ 'type' => 'structure', 'required' => [ 'results', 'workbookCursor', ], 'members' => [ 'results' => [ 'shape' => 'ResultSetMap', ], 'workbookCursor' => [ 'shape' => 'WorkbookCursor', ], 'nextToken' => [ 'shape' => 'PaginationToken', ], ], ], 'InternalServerException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'ErrorMessage', ], ], 'error' => [ 'httpStatusCode' => 500, ], 'exception' => true, ], 'InvokeScreenAutomationRequest' => [ 'type' => 'structure', 'required' => [ 'workbookId', 'appId', 'screenId', 'screenAutomationId', ], 'members' => [ 'workbookId' => [ 'shape' => 'ResourceId', 'location' => 'uri', 'locationName' => 'workbookId', ], 'appId' => [ 'shape' => 'ResourceId', 'location' => 'uri', 'locationName' => 'appId', ], 'screenId' => [ 'shape' => 'ResourceId', 'location' => 'uri', 'locationName' => 'screenId', ], 'screenAutomationId' => [ 'shape' => 'ResourceId', 'location' => 'uri', 'locationName' => 'automationId', ], 'variables' => [ 'shape' => 'VariableValueMap', ], 'rowId' => [ 'shape' => 'RowId', ], 'clientRequestToken' => [ 'shape' => 'ClientRequestToken', ], ], ], 'InvokeScreenAutomationResult' => [ 'type' => 'structure', 'required' => [ 'workbookCursor', ], 'members' => [ 'workbookCursor' => [ 'shape' => 'WorkbookCursor', ], ], ], 'MaxResults' => [ 'type' => 'integer', 'box' => true, 'max' => 100, 'min' => 1, ], 'Name' => [ 'type' => 'string', 'sensitive' => true, ], 'PaginationToken' => [ 'type' => 'string', 'max' => 1024, 'min' => 1, ], 'RawValue' => [ 'type' => 'string', ], 'RequestTimeoutException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'ErrorMessage', ], ], 'error' => [ 'httpStatusCode' => 504, ], 'exception' => true, ], 'ResourceId' => [ 'type' => 'string', 'pattern' => '[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}', ], 'ResourceNotFoundException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'ErrorMessage', ], ], 'error' => [ 'httpStatusCode' => 404, ], 'exception' => true, ], 'ResultHeader' => [ 'type' => 'list', 'member' => [ 'shape' => 'ColumnMetadata', ], ], 'ResultRow' => [ 'type' => 'structure', 'required' => [ 'dataItems', ], 'members' => [ 'rowId' => [ 'shape' => 'RowId', ], 'dataItems' => [ 'shape' => 'DataItems', ], ], ], 'ResultRows' => [ 'type' => 'list', 'member' => [ 'shape' => 'ResultRow', ], ], 'ResultSet' => [ 'type' => 'structure', 'required' => [ 'headers', 'rows', ], 'members' => [ 'headers' => [ 'shape' => 'ResultHeader', ], 'rows' => [ 'shape' => 'ResultRows', ], ], ], 'ResultSetMap' => [ 'type' => 'map', 'key' => [ 'shape' => 'Name', ], 'value' => [ 'shape' => 'ResultSet', ], ], 'RowId' => [ 'type' => 'string', 'pattern' => 'row:[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}\\/[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}', ], 'ServiceUnavailableException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'ErrorMessage', ], ], 'error' => [ 'httpStatusCode' => 503, ], 'exception' => true, ], 'ThrottlingException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'ErrorMessage', ], ], 'error' => [ 'httpStatusCode' => 429, ], 'exception' => true, ], 'ValidationException' => [ 'type' => 'structure', 'required' => [ 'message', ], 'members' => [ 'message' => [ 'shape' => 'ErrorMessage', ], ], 'error' => [ 'httpStatusCode' => 400, ], 'exception' => true, ], 'VariableName' => [ 'type' => 'string', 'sensitive' => true, ], 'VariableValue' => [ 'type' => 'structure', 'required' => [ 'rawValue', ], 'members' => [ 'rawValue' => [ 'shape' => 'RawValue', ], ], 'sensitive' => true, ], 'VariableValueMap' => [ 'type' => 'map', 'key' => [ 'shape' => 'VariableName', ], 'value' => [ 'shape' => 'VariableValue', ], 'sensitive' => true, ], 'WorkbookCursor' => [ 'type' => 'long', ], ],];
